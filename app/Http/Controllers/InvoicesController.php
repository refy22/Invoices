<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;
use App\Models\Invoices;
use App\Models\Sections;
use App\Models\User;
use App\Notifications\AddInvoice;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\directoryExists;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $invoices = Invoices::with('section')->get();
        
        // var_dump(
        //    dd($invoices)
        // );
        // foreach ($invoices as $invoice) {
        //     dd($invoice);
        // }
        $PLACE = 'الفواتير';
        $data=['stat' => 'NA'];
        return view('invoices.invoices', compact('invoices','data','PLACE'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Sections::all();
        return view('invoices.add_invoice',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $this->validate($request,[
            'invoice_number'=>'required|unique:invoices',
        ],[
            'invoice_number.unique' => 'The invoice number must be unique.',
        ]);
      $user_id = Auth::id();
      $invoice =  Invoices::create([
            'user' => $user_id,
            'invoice_number' => $request->invoice_number ,
            'invoice_date' => $request->invoice_Date,
            'due_date' => $request->Due_date , 
            'product' => $request->product , 
            'section_id' => $request->Section ,
            'amount_collection' => $request->Amount_collection ,
            'amount_commission' => $request->Amount_Commission ,
            'discount' => $request->Discount , 
            'rate_vat' => $request->Rate_VAT , 
            'value_vat' => $request->Value_VAT , 
            'total' => $request->Total ,
            'status' => 'غير مدفوع' ,
            'value_status' => 2 , 
            'note' => $request->note ,
        ]);
        // $invoice_id = Invoices::latest()->first()->id();
        $invoice_id = $invoice->id;
        InvoiceDetail::create([
            'invoice_id' => $invoice_id,
            'invoice_number' =>$request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => 'غير مدفوعة',
            'value_status' => 2 , 
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if($request->hasFile('pic')){
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number; 

            $attachments = new InvoiceAttachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = (Auth::user()->name);
            $attachments->invoice_id = $invoice->id;
            $attachments->save();
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('attachments/'.$invoice_number),$imageName);

        }

        $user = User::first();
        $user->notify(new AddInvoice($invoice_id));
        session()->flash('Add');
        return redirect('/invoices');
            // return $invoice_id;
        // return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $value = $request->payment;
         if($value == '1'){
            $status = 'مدفوع';
         }elseif($value == '2'){
            $status = 'غير مدفوع';
         }else{ $status = 'نظام دفع ';}

       $invoice =  Invoices::where('id' , $request->invoice_id)->first(); 
         $invoice->update([
            'status' => $status,
            'value_status' =>$value,
            'payment_date' => now(),
         ]);
        session()->flash('Status_Update');
        return back();
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoices = Invoices::where('id' , $id)->first();
        $sections = Sections::all();
        return view('invoices.edit_invoice' , compact('invoices','sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $invoices = Invoices::findOrFail($request->invoice_id);
        $invoices->update([
            'invoice_number' => $request->invoice_number ,
            'invoice_date' => $request->invoice_Date ,
            'due_date' => $request->Due_date ,
            'section_id' => $request->Section ,
            'product' => $request->product ,
            'amount_collection' => $request->Amount_collection ,
            'amount_commission' => $request->Amount_Commission ,
            'discount' => $request->Discount,
            'rate_vat' => $request->Rate_VAT,
            'value_vat' => $request->Value_VAT,
            'total' => $request->Total,
            'note' =>$request->note
        ]);
        session()->flash('edit','تم تعديل الفاتورة');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoice = Invoices::where('id' , $request->invoice_id)->first();
        
        $invoice->delete();
        session()->flash('archive_invoice');
        return redirect('/invoices');

    }
    public function restore(Request $request){
        // $invoice = Invoices::where('id' , $request->invoice_id)->first();
        // $invoice->update([
        //     'deleted_at'=>null
        // ]);
       

        Invoices::onlyTrashed()->where('id' , $request->invoice_id)->restore();
         session()->flash('restore');
        return redirect('/invoices');
    }

    /** 
     *  Get the product according to the section id
    */ 
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    
    public function paid(){
        $PLACE = 'الفواتير المدفوعة';
        $invoices = Invoices::where("value_status","1")->get();
        $data=['stat' => 'NA'];
        return view('invoices.invoices', compact('invoices','data','PLACE'));
    }
    
    public function unpaid(){
        $PLACE = 'الفواتير الغير مدفوعة';
        $invoices = Invoices::where("value_status","2")->get();
        $data=['stat' => 'NA'];
        return view('invoices.invoices', compact('invoices','data','PLACE'));
    }
    
    public function partial(){
        $PLACE = 'الفواتير المدفوعة جزئيا';
        $invoices = Invoices::where("value_status","3")->get();
        $data=['stat' => 'NA'];
        return view('invoices.invoices', compact('invoices','data','PLACE'));
    }

    public function archive(){
        $PLACE = 'الأرشيف';
        $invoices = Invoices::onlyTrashed()->get();
        $data=['stat' => 'A'];
        return view('invoices.invoices', compact('invoices','data','PLACE'));
    }
    public function forceDelete(Request $request){
        $id = $request->invoice_id;
        $invoice = Invoices::findOrFail($id);
        $folderPath = public_path('attachments/'.$invoice->invoice_number);
        if(directoryExists($folderPath)){
        File::deleteDirectory($folderPath);
        }
        $invoice->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/invoices');
        
    }


    public function printInvoice($id){
        $invoice = Invoices::findOrFail($id);
        return view('invoices.invoices_print',['invoices'=> $invoice]);
    }

    public function export() 
    {   
       
        return Excel::download(new InvoicesExport, 'Invoices.xlsx');
        //   session()->flash('export');
        //  return redirect('/invoices');

    }
}

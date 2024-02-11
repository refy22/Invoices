<?php

namespace App\Http\Controllers;

use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;
use App\Models\Invoices;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view("invoices.invoices", compact('invoices'));
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
        session()->flash('Add','تم اضافة الفاتورة بنجاح');
        return back();
            // return $invoice_id;
        // return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices $invoices)
    {
        //
    }

    /** 
     *  Get the product according to the section id
    */ 
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }
}

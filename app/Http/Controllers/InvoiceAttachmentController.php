<?php

namespace App\Http\Controllers;

use App\Models\InvoiceAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file_name' => 'mimes:pdf,jpeg,png,jpg'
        ],[
            'file_name.mimes' =>'صيغة الملف المرفق يحب ان تكون jpg , jpeg , pdf , png'
        ]);

        $fileName = $request->file('file_name')->getClientOriginalName();
        $attachment = new InvoiceAttachment();
        $attachment->file_name = $fileName;
        $attachment->invoice_number = $request->invoice_number;
        $attachment->invoice_id = $request->invoice_id;
        $attachment->created_by = Auth::user()->name;
        $attachment->save();

        //actual file 
        $file = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('attachments/'.$request->invoice_number),$file);
        session()->flash('Add','تم اضافة المرفق بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceAttachment $invoiceAttachment)
    {
        
    }
}

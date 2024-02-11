<?php

namespace App\Http\Controllers;

use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Psy\VersionUpdater\Downloader\FileDownloader;

use function PHPUnit\Framework\directoryExists;

class InvoiceDetailController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   $invoice = Invoices::where('id',$id)->first();
        $details = InvoiceDetail::where('invoice_id',$id)->first();
        $attachments = InvoiceAttachment::where('invoice_id',$id)->get(); 
        return view('invoices.details_invoice',compact(['details','invoice','attachments']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {$invoice = InvoiceAttachment::findOrFail($request->id_file);

        // Delete the attachment record from the database
        $invoice->delete();
        
        // Construct the full path to the attachment file
        $filePath = public_path('attachments/' . $invoice->invoice_number . '/' . $invoice->file_name);
        
        echo "File Path: " . $filePath . "<br>";

        if (file_exists($filePath)) {
            echo "File exists. Attempting to delete...<br>";
            if (unlink($filePath)) {
                echo 'File deleted successfully.<br>';
            } else {
                echo 'Failed to delete the file.<br>';
            }
        } else {
            echo 'File not found.<br>';
        }
        $folderPath = public_path('attachments/' . $invoice->invoice_number);
        echo "Folder Path: " . $folderPath . "<br>";

    //     // Check if the directory exists and is empty before attempting to delete it
    //     if (is_dir($folderPath)) {
    //      echo "Directory exists. Attempting to delete...<br>";
    //         if (rmdir($folderPath)) {
    //     echo 'Directory deleted successfully.<br>';
    //    } else {
    //     echo 'Failed to delete the directory.<br>';
    //      }
    //     } else {
    // echo 'Directory not found.<br>';
    //     }
    session()->flash('Delete','تم حذف المرفق');
    return back();
}

public function open_file($invoice_number, $file_name)
{
    $filePath = $invoice_number . '/' . $file_name;
    $fullPath = public_path('attachments/' . $filePath);

    
    if (file_exists($fullPath)) {
       
        return response()->file($fullPath);
    } else {
        
        return response()->json(['error' => 'File not found'], 404);
    }
}

    

    
    

    
    

// public function viewInvoicePdf($invoiceNumber, $fileName)
// {
//     // Construct the file path
//     $filePath = storage_path('public/attachments/' . $invoiceNumber . '/' . $fileName);

//     // Check if the file exists
//     if (file_exists($filePath)) {
//         // Serve the PDF file as a response
//         return Response::file($filePath, ['Content-Type' => 'application/pdf']);
//     } else {
//         // File not found, handle the error (e.g., return a response or redirect)
//         return response()->json(['error' => 'PDF not found'], 404);
//     }
// }


}

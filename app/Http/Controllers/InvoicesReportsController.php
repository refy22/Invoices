<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoicesReportsController extends Controller
{
    public function index(){
        return view('reports.invoices_report');
    }
}

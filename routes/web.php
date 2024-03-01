<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoicesReportsController;
use App\Models\InvoiceAttachment;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// c
// Route::get('/{id}', 'AdminController@index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/invoices' , InvoicesController::class);
Route::resource('/invoices/update',InvoicesController::class);
Route::delete('/invoicesDelete',[InvoicesController::class,'destroy'])->name('invoices.destroy');
Route::delete('/forcedelete',[InvoicesController::class,'forceDelete'])->name('invoices.forceDelete');

Route::put('/Status_show',[InvoicesController::class,'show'])->name('Status_show');
Route::get('/print/{id}',[InvoicesController::class,'printInvoice'])->name('invoices.invoices_print');
Route::get('exporte', [InvoicesController::class, 'export']);
Route::get('/paid',[InvoicesController::class,'paid']);
Route::get('/unpaid',[InvoicesController::class,'unpaid']);
Route::get('/partial',[InvoicesController::class,'partial']);
Route::get('/archive',[InvoicesController::class,'archive']);
Route::patch('/restore',[InvoicesController::class,'restore'])->name('invoices.restore');
Route::resource('sections', SectionsController::class);
Route::delete('/sections/{section}', [SectionsController::class, 'destroy'])->name('sections.destroy');
Route::resource('/products', ProductController::class);
Route::get('/section/{id}', [InvoicesController::class , 'getproducts']);
Route::get("InvoiceDetails/{id}",[InvoiceDetailController::class ,'edit']);
Route::get("View_file/{invoice_number}/{filename}",[InvoiceDetailController::class , 'open_file']);
Route::get('download/{invoice_number}/{filename}',[InvoiceDetailController::class,'download']);
Route::post('delete_file',[InvoiceDetailController::class,'destroy'])->name('delete_file');
Route::resource('InvoiceAttachments',InvoiceAttachmentController::class);
Route::get('edit_invoice/{id}',[InvoicesController::class,'edit']);
Route::get('/invoices_report', [InvoicesReportsController::class , 'index'])->name('reports.index');

Route::middleware('auth')->group(function () {


    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');


});




Auth::routes();

Route::get('/{id}', [AdminController::class, 'index']);



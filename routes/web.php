<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionsController;
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

Route::resource('sections', SectionsController::class);
Route::delete('/sections/{section}', [SectionsController::class, 'destroy'])->name('sections.destroy');

Route::resource('/products', ProductController::class);
Auth::routes();

Route::get('/{id}', [AdminController::class, 'index']);



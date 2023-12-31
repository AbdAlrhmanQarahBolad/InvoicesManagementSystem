<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerReport;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoicesReport;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
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



//Auth::routes();
Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/sections',SectionsController::class) ;
Route::resource('/invoices',InvoicesController::class) ;
Route::resource('/products', ProductsController::class);
Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles',RoleController::class);

    Route::resource('users',UserController::class);

    });


Route::get('export_invoices', [InvoicesController::class,'export']);

Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class,'edit']);

Route::get('/edit_invoice/{id}', [InvoicesController::class,'edit']);

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file']);

Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file');

Route::get('/Status_show/{id}', [InvoicesController::class,'show'])->name('Status_show');

Route::post('/Status_Update/{id}',[InvoicesController::class,'Status_Update'])->name('Status_Update');

Route::get('invoices_report', [InvoicesReport::class , 'index']);

Route::post('Search_invoices', [InvoicesReport::class , 'Search_invoices']);

Route::get('customers_report', [CustomerReport::class , 'index'])->name("customers_report");

Route::post('Search_customers', [CustomerReport::class , 'Search_customers']);

Route::get('/section/{id}',[InvoicesController::class , 'getproducts']);

Route::get('Invoice_Paid',[InvoicesController::class , 'Invoice_Paid']);

Route::get('Invoice_UnPaid',[InvoicesController::class , 'Invoice_UnPaid']);

Route::get('Invoice_Partial',[InvoicesController::class , 'Invoice_Partial']);

Route::get('MarkAsRead_all',[InvoicesController::class , 'MarkAsRead_all'])->name('MarkAsRead_all');

Route::get('Print_invoice/{id}',[InvoicesController::class , 'Print_invoice']);

Route::get('unreadNotifications_count', [InvoicesController::class , 'unreadNotifications_count'])->name('unreadNotifications_count');

Route::get('unreadNotifications', [InvoicesController::class , 'unreadNotifications'])->name('unreadNotifications');

Route::resource('Archive', InvoiceAchiveController::class);


Route::get('/{page}', [AdminController::class,'index']);





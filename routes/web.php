<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagescontroller;
use App\Http\Controllers\customerdash;
use App\Http\Controllers\admindash;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\favcontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/registration',[admindash::class,'registration'])->name('registration');

Route::post('/admin/registration',[admindash::class,'registersubmit'])->name('register.submit');

Route::get('/login',[PagesController::class,'login'])->name('login');
Route::post('/login',[PagesController::class,'loginsubmit'])->name('login');
Route::get('/logout',[PagesController::class,'logout'])->name('logout');
Route::get('/Changepass',[PagesController::class,'Changepass'])->name('Changepass')->middleware('authorized');
Route::post('/Changepassw',[PagesController::class,'Changepassubmit'])->name('Changepassword')->middleware('authorized');

Route::get('/admin/home',[admindash::class,'adminhome'])->name('admin.home')->middleware('authorized');
Route::get('/admin/cupon',[admindash::class,'managecupon'])->name('cupon')->middleware('authorized');
Route::post('/admin/cupon',[admindash::class,'cuponsubmit'])->name('cupon')->middleware('authorized');
Route::get('/admin/cuponslist',[admindash::class,'managecuponlist'])->name('cuponslist')->middleware('authorized');
Route::get('/admin/deletecupon/{id}',[admindash::class,'deletecupon'])->name('cupon.delete')->middleware('authorized');

Route::get('/admin/slide',[admindash::class,'slide'])->name('admin.slide')->middleware('authorized');
Route::post('/admin/slide',[admindash::class,'slideup'])->name('admin.slide')->middleware('authorized');
Route::get('/admin/slidelist',[admindash::class,'slidelist'])->name('admin.slidelist')->middleware('authorized');
Route::get('/admin/deleteslide/{id}',[admindash::class,'deleteslide'])->name('slide.delete')->middleware('authorized');

Route::post('/admin/addmedicine',[MedicineController::class,'addmedicine'])->name('addmedicine')->middleware('authorized');
Route::get('/admin/addmedicine',[MedicineController::class,'medicine'])->name('addmedicine')->middleware('authorized');

Route::get('/admin/medicinelist',[MedicineController::class,'listmedicine'])->name('medicinelist')->middleware('authorized');
Route::get('/admin/medicinesdel/{id}',[MedicineController::class,'delete'])->name('medicinedelete')->middleware('authorized');

Route::get('/admin/medicinesedit/{id}',[MedicineController::class,'editmedicine'])->name('medicine.edit')->middleware('authorized');
Route::post('/admin/medicinesedit/{id}',[MedicineController::class,'updatemedicine'])->name('medicine.edit')->middleware('authorized');


Route::get('/customer/home',[customerdash::class,'customerhome'])->name('customer.home')->middleware('authorized');

Route::get('/customer/medicinedetails/{id}/{name}',[MedicineController::class, 'medicinedetails'])->name('medicinedetails')->middleware('authorized');
Route::post('/customer/medicinedetails/{id}/{name}',[OrderController::class, 'ordermedicine'])->name('medicinedetails')->middleware('authorized');

Route::get('/admin/orderlist',[OrderController::class,'orderlist'])->name('order.list')->middleware('authorized');

Route::post('/customer/add-to-fav',[favcontroller::class, 'addfev'])->name('fav')->middleware('authorized');
//Route::post('/customer/add-to-fav/list',[favcontroller::class, 'addfevlist'])->name('fav.list')->middleware('authorized');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customerdash;
use App\Http\Controllers\admindash;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\favcontroller;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//coupon api crud
Route::post('/admin/cupon',[admindash::class,'cuponsubmit'])->name('cupon');
Route::post('/admin/cuponupdate',[admindash::class,'cuponupdate'])->name('cupon');
Route::post('/admin/deletecupon',[admindash::class,'deletecupon'])->name('cupon.delete');
Route::get('/admin/cuponslist',[admindash::class,'managecuponlist'])->name('cuponslist');

//slider api crud
Route::post('/admin/slideup',[admindash::class,'slideup']);
Route::post('/admin/slideupdate',[admindash::class,'slideupdate']);
Route::post('/admin/deleteslide',[admindash::class,'deleteslide'])->name('slide.delete');
Route::get('/admin/slidelist',[admindash::class,'slidelist'])->name('admin.slidelist');

//add to fav crud
Route::post('/customer/add-to-fav',[favcontroller::class, 'addfev'])->name('fav');
Route::post('/customer/add-to-fav/del',[favcontroller::class, 'addfevdel'])->name('fav.del1');
Route::post('/customer/add-to-fav/clear',[favcontroller::class, 'addfevclear'])->name('fav.clear');
Route::post('/customer/add-to-fav/list',[favcontroller::class, 'addfevlist'])->name('fav.list');

//search product
Route::post('/customer/medicine/search',[MedicineController::class, 'medicinesearch'])->name('med.sr');


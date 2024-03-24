<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');    
    Route::resource('/permission', App\Http\Controllers\PermissionController::class);
    Route::resource('/role', App\Http\Controllers\RoleController::class);
    Route::resource('/user', App\Http\Controllers\UserController::class);
    Route::resource('/supplier',App\Http\Controllers\SupplierController::class);
    Route::resource('/customer',App\Http\Controllers\CustomerController::class);
    Route::resource('/product',App\Http\Controllers\ProductController::class);
    Route::resource('/productin',App\Http\Controllers\ProductInController::class);
    Route::resource('/productout',App\Http\Controllers\ProductOutController::class);
    Route::resource('/productindetail',App\Http\Controllers\ProductInDetailController::class);
    Route::resource('/productoutdetail',App\Http\Controllers\ProductOutDetailController::class);
});

Route::get('/testing',function(){
    return view('pages.home');
});

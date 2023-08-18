<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Profile;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashobardContoller;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[DashobardContoller::class,'index']);
    Route::get('category',[CategoryController::class,'index']);
    Route::get('category/create',[CategoryController::class,'create']);
    Route::post('category',[CategoryController::class,'add']);
    Route::get('category/edit/{category}',[CategoryController::Class,'edit']);
    Route::put('category/{category}',[CategoryController::class,'update']);

    Route::get('products',[ProductController::class,'index']);
    Route::get('products/create',[ProductController::class,'create']);
    Route::post('products',[ProductController::class,'add']);
    Route::get('products/edit/{productid}',[ProductController::class,'edit']);
    Route::put('products/{product}',[ProductController::class,'update']);
    Route::get('product-image/delete/{image}',[ProductController::class,'destroy']);
    Route::get('products/delete/{productid}',[ProductController::class,'delete']);


    Route::controller(SliderController::class)->group(function(){
        Route::get('sliders','index');
        Route::get('sliders/create','create');
        Route::post('sliders','add');
        Route::get('sliders/edit/{slider}','edit');
        Route::put('sliders/{slider}','update');
        Route::get('sliders/delete/{id}','delete');
       });
       
       Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function(){
            Route::get('orders','index');
            Route::get('orders/{orderId}','showOrder');
            Route::put('orders/{orderId}','updateStatus');
            Route::get('invoice/generate/{id}','downloadpdf');
            Route::get('invoice/{id}','generatepdf');
            Route::get('invoice/mail/{id}','sendInvoiceMail');
       });

       Route::controller(UserController::class)->group(function(){
        Route::get('users','index');
        Route::get('user/create','create');
        Route::post('user','store');
        Route::get('user/delete/{userid}','delete');
   });
   });


Route::get('/',[FrontendController::class,'index']);
Route::get('/collections',[FrontendController::class,'categories']);
Route::get('/collections/{category}',[FrontendController::class,'cproducts']);
Route::get('/collections/{category}/{product}',[FrontendController::class,'viewproduct']);


Route::middleware(['auth'])->group(function(){
    Route::get('cart',[CartController::Class,'index']);
    Route::get('checkout',[CheckoutController::class,'index']);
    Route::get('orders',[OrderController::class,'index']);
    Route::get('orders/{orderId}',[OrderController::class,'orderDetails']);
    Route::get('profile',[Profile::class,'index']);
    Route::post('profile',[Profile::class,'updateuserdetails']);
    Route::get('change_password',[Profile::class,'passwordChange']);
    Route::post('change_password',[Profile::class,'passwordUpdate']);
});

Route::get('search' ,[FrontendController::class,'searchproduct']);
Route::get('thank-you',[FrontendController::class,'thankYou']);



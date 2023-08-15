<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProductController;


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
// Guest pages
Route::get('/', [GuestController:: class,'home']);
Route::get('/product/details/{id}', [GuestController:: class,'productDetails']);
Route::get('/products/{categoryid}/list', [GuestController:: class,'shop']);
Route::post('/products/search', [GuestController:: class,'search']);
Auth::routes();
//route client
Route::get('/user/dashboard',[ClientController:: class,'dashboard'] )->middleware('auth','is_active');

Route::get('/user/profile',[ClientController:: class,'profile'] )->middleware('auth');
Route::post('/user/profile/update',[ClientController:: class,'update'] )->middleware('auth');
Route::post('/user/review/store',[ClientController:: class,'addReview'] )->middleware('auth');
Route::post('/user/order/store',[CommandeController:: class,'store'] )->middleware('auth');
Route::get('/user/cart',[ClientController:: class,'cart'] )->middleware('auth');
Route::get('/user/lc/{idlc}/delete',[CommandeController:: class,'lignedelete'] )->middleware('auth');
Route::post('/user/checkout',[ClientController:: class,'checkout'] )->middleware('auth');
Route::get('/user/commandes',[ClientController:: class,'commandes'] )->middleware('auth');
Route::get('/user/bloquer',[ClientController:: class,'affichermessagebloquee'] )->middleware('auth');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout']);
//route admin

Route::get('/admin/dashboard',[AdminController:: class,'dashboard'])->middleware('auth','admin');
Route::get('/admin/profile',[AdminController:: class,'profile'])->middleware('auth','admin');
Route::post('/admin/profile/update',[AdminController:: class,'update'] )->middleware('auth','admin');
Route::get('/admin/categories',[CategoryController:: class,'index'] )->middleware('auth','admin');
Route::post('/admin/categorie/store',[CategoryController:: class,'store'] )->middleware('auth','admin');
Route::get('/admin/categories/{id}/delete',[CategoryController:: class,'delete'] )->middleware('auth','admin');
Route::post('/admin/categorie/update',[CategoryController:: class,'update'] )->middleware('auth','admin');
Route::post('/admin/profile/update',[AdminController:: class,'update'] )->middleware('auth','admin');
Route::get('/admin/user',[AdminController:: class,'users'])->middleware('auth','admin');
Route::get('/admin/user/{id}/bloqer',[AdminController:: class,'Bloqer'])->middleware('auth','admin');
Route::get('/admin/user/{id}/debloqer',[AdminController:: class,'Debloqer'])->middleware('auth','admin');
Route::get('/admin/commandes',[AdminController:: class,'commandes'] )->middleware('auth','admin');
Route::post('/admin/product/search',[ProductController:: class,'searchproduct'] )->middleware('auth','admin');


//route product



Route::get('/admin/products',[ProductController:: class,'index'] )->middleware('auth','admin');
Route::post('/admin/products/store',[ProductController :: class,'store'] )->middleware('auth','admin');
Route::get('/admin/products/{id}/delete',[ProductController :: class,'delete'] )->middleware('auth','admin');
Route::post('/admin/products/update',[ProductController :: class,'update'] )->middleware('auth','admin');
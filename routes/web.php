<?php

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

Auth::routes();
Route::post('/product/add/{product}','UserController@addToCart');
Route::post('/product/change','UserController@changeOrderNumber');

Route::get('/home', 'ProductController@index')->name('home');
Route::get('/products/{product}', 'ProductController@show');
Route::get('/cart','UserController@showCart');

Route::get('/checkout','CheckoutController@showCheckoutPage');

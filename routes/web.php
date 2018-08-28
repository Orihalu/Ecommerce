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

Route::post('/home','ProductController@search');

Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
	Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

	Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
	Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');

	// Route::get('home', 'Admin\HomeController@index')->name('admin.home');
});

// Route::get('/home', 'HomeController@index');

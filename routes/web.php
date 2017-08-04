<?php

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::get('/home', 'ProductController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
	Route::get('/categories/{main_category}', 'ProductController@products')->name('categories');
	Route::any('/products/filters/ajax-division', 'ProductController@filterResults');
	Route::get('/carts/preview', 'CartController@preview')->name('preview');
	Route::resource('products', 'ProductController');
	Route::resource('carts', 'CartController');
	Route::resource('orders', 'OrderController');
	Route::any('createorder', 'OrderController@createorder')->name('createorder');


});


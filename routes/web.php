<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'ProductController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
	Route::any('/products/{main_category?}', 'ProductController@products')->name('products');
	Route::any('/products/filters/ajax-division', 'ProductController@filterResults');

});


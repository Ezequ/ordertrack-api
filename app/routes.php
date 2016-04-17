<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Currently use post and get methods, but get will be deleted in future */
Route::post('/login', 'AuthController@login');
Route::get('/login', 'AuthController@login');
Route::resource('client', 'ClientController');
Route::get('/client/getFromToday/{sellerId}', 'ClientController@getFromToday');
Route::get('orders/getProducts', 'OrdersController@getProductsByOrder');
Route::post('orders/addProductToOrder', 'OrdersController@addProductToOrder');
Route::post('orders/removeProductFromOrder', 'OrdersController@removeProductFromOrder');
Route::get('orders/addProductToOrder', 'OrdersController@addProductToOrder');
Route::get('orders/getActiveProductOrder/{id}', 'OrdersController@getActiveProductOrder');
Route::get('orders/getProductsFromActiveOrder/{id}', 'OrdersController@getProductsFromActiveOrder');
Route::get('orders/confirmOrder/{id}', 'OrdersController@confirmOrder');
Route::post('orders/confirmOrder/{id}', 'OrdersController@confirmOrder');
Route::resource('products', 'ProductsController');
Route::resource('categories', 'CategoriesController');
Route::resource('orders', 'OrdersController');
Route::group(array('before' => 'tokenauth'), function()
{
    Route::get('/', 'HomeController@showHome');
});
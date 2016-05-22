<?php
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
Route::resource('report', 'ReportController');
Route::get('report/getReport/{id}', 'ReportController@getReport');
Route::resource('discount', 'DiscountsController');
Route::group(array('before' => 'tokenauth'), function()
{
 Route::get('/', 'HomeController@showHome');
});
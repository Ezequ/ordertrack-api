<?php
Route::get('/adm/login', 'HomeControllerAdm@getLogin');
Route::post('/adm/login', 'HomeControllerAdm@postLogin');
Route::group(array('prefix' => 'adm', 'before' => 'auth'), function()
{
	Route::get('/logout', 'HomeControllerAdm@getLogout');
	/*	Home	*/
	Route::get('/', 'HomeControllerAdm@getHome');
	/*	Categorias	*/
	Route::get('/categoria', 'CategoryControllerAdm@getListado');
	Route::get('/categoria/crear', 'CategoryControllerAdm@getCreate');
	Route::get('/categoria/editar/{id}', 'CategoryControllerAdm@getEdit');
	Route::post('/categoria/editar/{id}', 'CategoryControllerAdm@postEdit');
	Route::post('/categoria/crear', 'CategoryControllerAdm@postCreate');
	Route::get('/categoria/borrar/{id}', 'CategoryControllerAdm@getDelete');
	/*	Categorias	*/
	Route::get('/producto', 'ProductsControllerAdm@getListado');
	Route::get('/producto/crear', 'ProductsControllerAdm@getCreate');
	Route::get('/producto/editar/{id}', 'ProductsControllerAdm@getEdit');
	Route::post('/producto/editar/{id}', 'ProductsControllerAdm@postEdit');
	Route::post('/producto/crear', 'ProductsControllerAdm@postCreate');
	Route::get('/producto/borrar/{id}', 'ProductsControllerAdm@getDelete');
	/*	Usuarios	*/
	Route::get('/usuario', 'UsuarioControllerAdm@getListado');
	Route::get('/usuario/crear', 'UsuarioControllerAdm@getCreate');
	Route::get('/usuario/editar/{id}', 'UsuarioControllerAdm@getEdit');
	Route::post('/usuario/editar/{id}', 'UsuarioControllerAdm@postEdit');
	Route::post('/usuario/crear', 'UsuarioControllerAdm@postCreate');
	Route::get('/usuario/borrar/{id}', 'UsuarioControllerAdm@getDelete');
	/*	Imagenes generales	*/
	Route::get('/imagenes', 'ImagenesGeneralesControllerAdm@getEdit');
	/*	Pedidos	*/
	Route::get('/pedido', 'PedidosControllerAdm@getListado');
	Route::get('/pedido/index', 'PedidosControllerAdm@index');
	Route::get('/pedido/detalle/{id}', 'PedidosControllerAdm@getDetalle');
});
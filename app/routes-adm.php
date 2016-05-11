<?php
Route::get('/adm/login', 'HomeControllerAdm@getLogin');
Route::post('/adm/login', 'HomeControllerAdm@postLogin');
Route::group(array('prefix' => 'adm', 'before' => 'auth|rol'), function()
{
	Route::get('/logout', 'HomeControllerAdm@getLogout');
	/*	Home	*/
	Route::get('/', 'HomeControllerAdm@getHome');
	/*	Categorias	*/
	Route::get('/categoria', 'CategoryControllerAdm@getListado');
	Route::get('/categoria/crear', 'CategoryNewControllerAdm@getCreate');
	Route::get('/categoria/editar/{id}', 'CategoryEditControllerAdm@getEdit');
	Route::post('/categoria/editar/{id}', 'CategoryNewControllerAdm@postEdit');
	Route::post('/categoria/crear', 'CategoryControllerAdm@postCreate');
	Route::get('/categoria/borrar/{id}', 'CategoryControllerAdm@getDelete');
	/*	Categorias	*/
	Route::get('/producto', 'ProductsControllerAdm@getListado');
	Route::get('/producto/crear', 'ProductsNewControllerAdm@getCreate');
	Route::get('/producto/editar/{id}', 'ProductsEditControllerAdm@getEdit');
	Route::post('/producto/editar/{id}', 'ProductsControllerAdm@postEdit');
	Route::post('/producto/crear', 'ProductsControllerAdm@postCreate');
	Route::get('/producto/borrar/{id}', 'ProductsControllerAdm@getDelete');
	/*	Usuarios	*/
	Route::get('/usuario', 'UsuarioControllerAdm@getListado');
	Route::get('/usuario/crear', 'UsuarioNewControllerAdm@getCreate');
	Route::get('/usuario/editar/{id}', 'UsuarioEditControllerAdm@getEdit');
	Route::post('/usuario/editar/{id}', 'UsuarioControllerAdm@postEdit');
	Route::post('/usuario/crear', 'UsuarioControllerAdm@postCreate');
	Route::get('/usuario/borrar/{id}', 'UsuarioControllerAdm@getDelete');
	/*	Imagenes generales	*/
	Route::get('/imagenes', 'ImagenesGeneralesControllerAdm@getEdit');
	/*	Pedidos	*/
	Route::get('/pedido', 'PedidosControllerAdm@getListado');
	Route::get('/pedido/index', 'PedidosControllerAdm@index');
	Route::get('/pedido/detalle/{id}', 'PedidosControllerAdm@getDetalle');
	Route::get('/pedido/changeStatus', 'PedidosControllerAdm@changeStatus');
	/*	Clientes	*/
	Route::get('/cliente', 'ClientsControllerAdm@getListado');
	Route::get('/cliente/crear', 'ClientsNewControllerAdm@getCreate');
	Route::get('/cliente/editar/{id}', 'ClientsEditControllerAdm@getEdit');
	Route::post('/cliente/editar/{id}', 'ClientsEditControllerAdm@postEdit');
	Route::post('/cliente/crear', 'ClientsNewControllerAdm@postCreate');
	Route::get('/cliente/borrar/{id}', 'ClientsControllerAdm@getDelete');
	Route::get('/cliente/imprimir/{id}', 'ClientsControllerAdm@getPrint');
	Route::get('/cliente/delete/{id}', 'ClientsControllerAdm@getDelete');
});
<?php
Route::get('/adm/login', 'HomeControllerAdm@getLogin');
Route::post('/adm/login', 'HomeControllerAdm@postLogin');
Route::group(array('prefix' => 'adm', 'before' => 'auth'), function()
{
	Route::get('/logout', 'HomeControllerAdm@getLogout');
	/*	Home	*/
	Route::get('/', 'HomeControllerAdm@getHome');
	/*	Imagenes	*/
	Route::get('/editar_foto', 'ArchivosControllerAdm@getFile');
	Route::get('/borrar_foto', 'ArchivosControllerAdm@deleteFile');
	Route::post('/editar_foto', 'ArchivosControllerAdm@changeFile');
	/*	Presupuestador	*/
	Route::get('/presupuestador', 'PresupuestadorControllerAdm@getListado');
	Route::get('/presupuestador/crear', 'PresupuestadorControllerAdm@getCreate');
	Route::get('/presupuestador/editar/{id}', 'PresupuestadorControllerAdm@getEdit');
	Route::post('/presupuestador/editar/{id}', 'PresupuestadorControllerAdm@postEdit');
	Route::post('/presupuestador/crear', 'PresupuestadorControllerAdm@postCreate');
	Route::get('/presupuestador/borrar/{id}', 'PresupuestadorControllerAdm@getDelete');
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
	/* Subcategorias */
	Route::get('/subcategoria', 'SubcategoriasControllerAdm@getListado');
	Route::get('/subcategoria/crear', 'SubcategoriasControllerAdm@getCreate');
	Route::get('/subcategoria/editar/{id}', 'SubcategoriasControllerAdm@getEdit');
	Route::post('/subcategoria/editar/{id}', 'SubcategoriasControllerAdm@postEdit');
	Route::post('/subcategoria/crear', 'SubcategoriasControllerAdm@postCreate');
	Route::get('/subcategoria/borrar/{id}', 'SubcategoriasControllerAdm@getDelete');
	/*	Promociones	*/
	Route::get('/promocion', 'PromocionesControllerAdm@getListado');
	Route::get('/promocion/crear', 'PromocionesControllerAdm@getCreate');
	Route::get('/promocion/editar/{id}', 'PromocionesControllerAdm@getEdit');
	Route::post('/promocion/editar/{id}', 'PromocionesControllerAdm@postEdit');
	Route::post('/promocion/crear', 'PromocionesControllerAdm@postCreate');
	Route::get('/promocion/borrar/{id}', 'PromocionesControllerAdm@getDelete');
	/*	Descarga	*/
	Route::get('/descarga', 'DescargasControllerAdm@getListado');
	Route::get('/descarga/crear', 'DescargasControllerAdm@getCreate');
	Route::get('/descarga/editar/{id}', 'DescargasControllerAdm@getEdit');
	Route::post('/descarga/editar/{id}', 'DescargasControllerAdm@postEdit');
	Route::post('/descarga/crear', 'DescargasControllerAdm@postCreate');
	Route::get('/descarga/borrar/{id}', 'DescargasControllerAdm@getDelete');
	/*	Secciones	*/
	Route::get('/seccion', 'SeccionesControllerAdm@getListado');
	Route::get('/seccion/crear', 'SeccionesControllerAdm@getCreate');
	Route::get('/seccion/editar/{id}', 'SeccionesControllerAdm@getEdit');
	Route::post('/seccion/editar/{id}', 'SeccionesControllerAdm@postEdit');
	Route::post('/seccion/crear', 'SeccionesControllerAdm@postCreate');
	/*	Home Slider	*/
	Route::get('/homeslider', 'HomeSliderControllerAdm@getListado');
	Route::get('/homeslider/crear', 'HomeSliderControllerAdm@getCreate');
	Route::get('/homeslider/editar/{id}', 'HomeSliderControllerAdm@getEdit');
	Route::post('/homeslider/editar/{id}', 'HomeSliderControllerAdm@postEdit');
	Route::post('/homeslider/crear', 'HomeSliderControllerAdm@postCreate');
	Route::get('/homeslider/borrar/{id}', 'HomeSliderControllerAdm@getDelete');
	/*	Usuarios	*/
	Route::get('/usuario', 'UsuarioControllerAdm@getListado');
	Route::get('/usuario/crear', 'UsuarioControllerAdm@getCreate');
	Route::get('/usuario/editar/{id}', 'UsuarioControllerAdm@getEdit');
	Route::post('/usuario/editar/{id}', 'UsuarioControllerAdm@postEdit');
	Route::post('/usuario/crear', 'UsuarioControllerAdm@postCreate');
	Route::get('/usuario/borrar/{id}', 'UsuarioControllerAdm@getDelete');
	/*	Metadata	*/
	Route::get('/metadata', 'MetadataControllerAdm@getListado');
	Route::get('/metadata/editar/{id}', 'MetadataControllerAdm@getEdit');
	Route::post('/metadata/editar/{id}', 'MetadataControllerAdm@postEdit');
	/*	Imagenes generales	*/
	Route::get('/imagenes', 'ImagenesGeneralesControllerAdm@getEdit');

});
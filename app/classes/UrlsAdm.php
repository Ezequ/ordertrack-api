<?php
class UrlsAdm
{
	public static function postLogin()
	{
		return "/adm/login";	
	}

	public static function getViewHome()
	{
		return "/adm";	
	}

	public static function getMenu()
	{
		return array(
			/*"Home" => array(
				"Listar sliders" => "/adm/homeslider",
				"Crear slider" => "/adm/homeslider/crear",
				),
			"Familias" => array(
				"Listar familias" => "/adm/presupuestador",
				"Crear familia" => "/adm/presupuestador/crear",
				),


			"Promociones" => array(
				"Listar productos" => "/adm/promocion",
				"Crear producto" => "/adm/promocion/crear",
				),
			"Descargas" => array(
				"Listar descargas" => "/adm/descarga",
				"Crear descarga" => "/adm/descarga/crear",
				),
			"Datos de secciones" => array(
				"Listar secciones" => "/adm/seccion",
				),
			"Metadata" => array(
				"Listar metadata" => "/adm/metadata",
				),*/
			"Productos" => array(
				"Listar productos" => "/adm/producto",
				"Crear producto" => "/adm/producto/crear",
			),
			"Categorias" => array(
				"Listar categorias" => "/adm/categoria",
				"Crear categoria" => "/adm/categoria/crear",
			),
			"Usuarios" => array(
				"Listar usuarios" => "/adm/usuario",
				"Crear usuario" => "/adm/usuario/crear",
				),
			/*"Imagenes generales" => array(
				"Listar imagenes generales" => "/adm/imagenes",
				),*/
		);
	}


}
<?php
class UrlsAdm
{
	public static function postLogin()
	{
		return "/adm/login";	
	}

	public static function getLogout()
	{
		return "/adm/logout";
	}

	public static function getUserData()
	{
		return "/adm/usuario/editar/" . Auth::user()->id;
	}

	public static function getViewHome()
	{
		return "/adm";	
	}

	public static function getChangeStatus()
	{
		return "/adm/pedido/changeStatus";
	}

	public static function getDetalle()
	{
		return "/adm/pedido/detalle/";
	}

	public static function getPedidos()
	{
		return "/adm/pedido";
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

			/*"Imagenes generales" => array(
				"Listar imagenes generales" => "/adm/imagenes",
				),*/

			/*"Pedidos" => array(
				"Listar pedidos" => "/adm/pedido?id_estado=" . Order::CONFIRM_STATE,

			"Pedidos" => array(
/*				"Listar pedidos" => "/adm/pedido?id_estado=" . Order::CONFIRM_STATE,
				"Listar pedidos" => "/adm/pedido",
			),
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
				),*/

			"Pedidos" => array(
				"icon" => "shopping-cart",
				"submenu" => array(
					"Listar pedidos" => "/adm/pedido?id_estado=" . Order::CONFIRM_STATE,
					"Listar pedidos" => "/adm/pedido",
				)
			),
			"Productos" => array(
				"icon" => "cubes",
				"submenu" => array(
					"Listar productos" => "/adm/producto",
					"Crear producto" => "/adm/producto/crear",
				)
			),
			"Categorias" => array(
				"icon" => "tag",
				"submenu" => array(
					"Listar categorias" => "/adm/categoria",
					"Crear categoria" => "/adm/categoria/crear",
				)
			),
			"Usuarios" => array(
				"icon" => "users",
				"submenu" => array(
					"Listar usuarios" => "/adm/usuario",
					"Crear usuario" => "/adm/usuario/crear",
				)
			)
		);
	}


}
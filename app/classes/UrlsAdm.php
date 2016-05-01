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
					"Listado de pedidos" => "/adm/pedido?id_estado=" . Order::CONFIRM_STATE,
					"Listado de pedidos" => "/adm/pedido?" . self::getOrdersCustomFilters(),
				)
			),
			"Productos" => array(
				"icon" => "cubes",
				"submenu" => array(
					"Listado de productos" => "/adm/producto",
					"Crear producto" => "/adm/producto/crear",
				)
			),
			"Categorías" => array(
				"icon" => "tag",
				"submenu" => array(
					"Listado de categorías" => "/adm/categoria",
					"Crear categoría" => "/adm/categoria/crear",
				)
			),
			"Usuarios" => array(
				"icon" => "users",
				"submenu" => array(
					"Listado de usuarios" => "/adm/usuario",
					"Crear usuario" => "/adm/usuario/crear",
				)
			)
		);
	}

	public static function getOrdersCustomFilters()
	{
		$currentDate = date('Y-m-d');
		$date = strtolower(date("l", strtotime($currentDate)));
		if ($date == "sunday") {
			$from = date('Y-m-d');
			$to = date('Y-m-d', strtotime('next Saturday', strtotime($currentDate)));
		} else if($date == "saturday") {
			$to = date('Y-m-d');
			$from = date('Y-m-d', strtotime('last Sunday', strtotime($currentDate)));
		} else {
			$from = date('Y-m-d', strtotime('last Sunday', strtotime($currentDate)));
			$to = date('Y-m-d', strtotime('next Saturday', strtotime($currentDate)));
		}
		return "fecha_confirmacion>=" . $from . "&fecha_confirmacion<=" . $to . "&orderby=fecha_confirmacion&orientation=desc";
	}


}
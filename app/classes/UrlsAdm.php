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

	public static function getClientEdit($id)
	{
		return "/adm/cliente/editar/{$id}";
	}

	public static function getClientPrintQr($id)
	{
		return "/adm/cliente/imprimir/{$id}";
	}

	public static function getClientDelete($id)
	{
		return "/adm/cliente/delete/{$id}";
	}

	public static function getMenu()
	{
		return array(
			"Clientes" => array(
				"icon" => "suitcase",
				"allowed-rols" => "1,2",
				"submenu" => array(
					"Listado de clientes" => "/adm/cliente",
					"Crear cliente" => "/adm/cliente/crear",
				)
			),

			"Pedidos" => array(
				"allowed-rols" => "1,2",
				"icon" => "shopping-cart",
				"submenu" => array(
					"Listado de pedidos" => "/adm/pedido?id_estado=" . Order::CONFIRM_STATE,
					"Listado de pedidos" => "/adm/pedido?" . self::getOrdersCustomFilters(),
				)
			),
			"Productos" => array(
				"allowed-rols" => "2",
				"icon" => "cubes",
				"submenu" => array(
					"Listado de productos" => "/adm/producto",
					"Crear producto" => "/adm/producto/crear",
				)
			),
			"Categorías" => array(
				"allowed-rols" => "2",
				"icon" => "tag",
				"submenu" => array(
					"Listado de categorías" => "/adm/categoria",
					"Crear categoría" => "/adm/categoria/crear",
				)
			),
			"Usuarios" => array(
				"allowed-rols" => "2",
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
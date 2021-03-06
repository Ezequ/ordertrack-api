<?php
class UrlsAdm
{
	const D_M_Y = 'd-m-Y';
	const Y_M_D = 'Y-m-d';

	public static function postLogin()
	{
		return "/adm/login";	
	}

	public static function getSchedule()
	{
		return "/adm/agenda";
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

	public static function getSaveScheduleUrl()
	{
		return "/adm/agenda/agendar-cliente";
	}
	public static function getMigrateDayScheduleUrl()
	{
		return "/adm/agenda/migrar-clientes";
	}

	public static function getDeleteScheduleUrl()
	{
		return "/adm/agenda/eliminar-cliente";
	}

	public static function getDefaultSchedule($from,$to,$seller)
	{
		return "/adm/agenda/agenda-defecto?from={$from}&to={$to}&id={$seller}";
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
			'Clientes' => array(
				'icon' => 'suitcase',
				'allowed-rols' => '1,2',
				'module' => 'cliente',
				'href' => '',
				'submenu' => array(
					'Listado de clientes' => '/adm/cliente',
				)
			),
			'Agenda' => array(
				'allowed-rols' => '2',
				'icon' 	=> 'calendar',
				'module'  => 'agenda',
				'href' => '/adm/agenda?' . self::getSchedulesCustomFilters(),
				'submenu' => array()
			),
			'Pedidos' => array(
				'allowed-rols' => '1,2',
				'icon' => 'shopping-cart',
				'module' => 'pedido',
				'href' => '',
				'submenu' => array(
					'Listado de pedidos' => '/adm/pedido?' . self::getOrdersCustomFilters(),
				)
			),
			'Productos' => array(
				'allowed-rols' => '2',
				'icon' => 'cubes',
				'module' => 'producto',
				'href' => '',
				'submenu' => array(
					'Listado de productos' => '/adm/producto',
				)
			),
			'Categorías' => array(
				'allowed-rols' => '2',
				'icon' => 'tag',
				'module' => 'categoria',
				'href' => '',
				'submenu' => array(
					'Listado de categorías' => '/adm/categoria',
				)
			),
			'Usuarios' => array(
				'allowed-rols' => '2',
				'icon' => 'users',
				'module' => 'usuario',
				'href' => '',
				'submenu' => array(
					'Listado de usuarios' => '/adm/usuario',
				)
			)
		);
	}

	public static function getOrdersCustomFilters()
	{
		$currentDate = date('' . self::D_M_Y . '');
		$date = strtolower(date("l", strtotime($currentDate)));
		if ($date == "sunday") {
			$from = date(self::D_M_Y);
			$to = date(self::D_M_Y, strtotime('next Saturday', strtotime($currentDate)));
		} else if($date == "saturday") {
			$to = date(self::D_M_Y);
			$from = date(self::D_M_Y, strtotime('last Sunday', strtotime($currentDate)));
		} else {
			$from = date(self::D_M_Y, strtotime('last Sunday', strtotime($currentDate)));
			$to = date(self::D_M_Y, strtotime('next Saturday', strtotime($currentDate)));
		}
		return "fecha_confirmacion>=" . $from . "&fecha_confirmacion<=" . $to . "&orderby=fecha_confirmacion&orientation=desc";
	}

	public static function getSchedulesCustomFilters()
	{
		$currentDate = date(self::Y_M_D);
		$date = strtolower(date("l", strtotime($currentDate)));
		if ($date == "sunday") {
			$from = date(self::Y_M_D);
			$to = date(self::Y_M_D, strtotime('next Saturday', strtotime($currentDate)));
		} else if($date == "saturday") {
			$to = date(self::Y_M_D);
			$from = date(self::Y_M_D, strtotime('last Sunday', strtotime($currentDate)));
		} else {
			$from = date(self::Y_M_D, strtotime('last Sunday', strtotime($currentDate)));
			$to = date(self::Y_M_D, strtotime('next Saturday', strtotime($currentDate)));
		}
		return "from=" . $from ;
	}

	public static function getAllowedRolsByModule($module)
	{
		foreach (self::getMenu() as $index => $item) {
			if ($item['module'] == $module){
				return isset($item['allowed-rols']) ? $item['allowed-rols'] : '0';
			}
		}
	}

	public static function uriAllowedByAnyLoggedUser($uri)
	{
		foreach (self::getExceptionsUris() as $exceptionUri) {
			if (strpos($exceptionUri, $uri) !== false )
				return true;
		}
		return false;
	}

	public static function getExceptionsUris()
	{
		return array(
			'adm/logout'
		);
	}


}
<?php

class Schedule extends Model {

	protected  $_paginatation = 99999999;

	protected $fillable = ['id_cliente', 'fecha_visita_programada', 'fecha_visita_concretada'];

	protected $table = "agenda";

	public $timestamps = false;

	public static function getFromAndToFromThisWeek()
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
		return array('from' => $from, 'to' => $to);
	}

	public static function saveCustomerScheduleForThisWeek($idCustomer,$dateSchedule,$dateVisited)
	{
		if (!$idCustomer){
			return null;
		}
		$fromTo = self::getFromAndToFromThisWeek();
		$customerScheduled = Schedule::where('id_cliente', $idCustomer)
			->where('fecha_visita_programada', "<=", $fromTo['to'])
			->where('fecha_visita_programada', ">=", $fromTo['from'])
			->first();
		if (!$customerScheduled) {
			$customerScheduled = new Schedule();
			$customerScheduled->id_cliente = $idCustomer;
		}
		if ($dateSchedule){
			$customerScheduled->fecha_visita_programada = $dateSchedule;
		}
		if ($dateVisited){
			$customerScheduled->fecha_visita_concretada = $dateVisited;
		}
		return $customerScheduled->save();
	}

	public static function getCustomersScheduled($dayFrom = null, $dayTo = null,$seller = null)
	{
		$query = DB::table('agenda')
					->leftJoin('clientes', 'agenda.id_cliente', '=', 'clientes.id');
		$fromTo = self::getFromAndToFromThisWeek();
		$dayFrom = $dayFrom ? $dayFrom : $fromTo['from'];
		$dayTo = $dayTo ? $dayTo : $fromTo['to'];
		$query->where('fecha_visita_programada', ">=", $dayFrom)
			  ->where('fecha_visita_programada', "<=", $dayTo);
		if ($seller){
			$query->where('id_vendedor',$seller);
		}
		return $query->get();
	}

}
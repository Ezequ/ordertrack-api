<?php

class Schedule extends Model {

	protected $primaryKey = 'id_agenda';

	protected  $_paginatation = 99999999;

	protected $fillable = ['id_cliente', 'fecha_visita_programada', 'fecha_visita_concretada','id_agenda','comentario','pedido_hecho','id_orden'];

	protected $table = "agenda";

	public $timestamps = false;

	public static function getFromAndToFromThisWeek($date = null)
	{
		$currentDate = $date ? $date : date('Y-m-d');
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

	public static function saveCustomerScheduleForThisWeek($idCustomer,$dateSchedule,$dateVisited,$sellerId)
	{
		if (!$idCustomer || !$dateSchedule){
			return null;
		} else {
			$client = Client::find($idCustomer);
			if (!$client){
				return null;
			}
		}
		$fromTo = self::getFromAndToFromThisWeek($dateSchedule);
		$customerScheduled = Schedule::where('id_cliente', $idCustomer)
			->where('fecha_visita_programada', "<=", $fromTo['to'])
			->where('fecha_visita_programada', ">=", $fromTo['from'])
			->first();
		if (!$customerScheduled) {
			$customerScheduled = new Schedule();
			$customerScheduled->id_cliente = $idCustomer;
		}
		if ($sellerId){
			$customerScheduled->id_vendedor = $sellerId;
		}
		if ($dateSchedule){
			$customerScheduled->fecha_visita_programada = $dateSchedule;
		}
		if ($dateVisited){
			$customerScheduled->fecha_visita_concretada = $dateVisited;
		}
		$customerScheduled->save();
        return $customerScheduled;
	}

	public static function getCustomersScheduled($dayFrom = null, $dayTo = null,$seller = null,$returnCollection = true)
	{
		$return = null;
		$query = DB::table('agenda')
					->leftJoin('clientes', 'agenda.id_cliente', '=', 'clientes.id');
		$fromTo = self::getFromAndToFromThisWeek();
		$dayFrom = $dayFrom ? $dayFrom : $fromTo['from'];
		$dayTo = $dayTo ? $dayTo : $fromTo['to'];
		$query->where('fecha_visita_programada', ">=", $dayFrom)
			  ->where('fecha_visita_programada', "<=", $dayTo);
		if ($seller){
			$query->where('agenda.id_vendedor',$seller);
		}
		if ($returnCollection){
			$return = $query->get();
		} else {
			$return = $query;
		}
		return $return;
	}

	public static function getCustomersNotScheduled($from,$to,$seller)
	{
		/* All customers scheduled between from a to dates no matter seller id */
		$customersScheluded = self::getCustomersScheduled($from,$to);
		$ids = array();
		foreach ($customersScheluded as $index => $customer) {
			$ids[] = $customer->id_cliente;
		}
		$customers = Client::whereNotIn('id',$ids)->where('estado','>=' ,ClientsStatesDefinition::STATE_NORMAL);
		if ($seller){
			$customers->where('id_vendedor',$seller);
		}
		return $customers->get();
	}

	public static function changeDayAndSellerToSchedule($scheduleId,$sellerId,$dayTo)
	{
		$schedule = self::find($scheduleId);
		if ($schedule){
			$schedule->id_vendedor = $sellerId;
			$schedule->fecha_visita_programada = $dayTo;
			$schedule->save();
		}
		return $schedule;
	}

	public static function getCardClass($schedule)
	{
		if (!$schedule->fecha_visita_concretada && $schedule->id_orden == "0"){
			return "default";
		}
		if ($schedule->fecha_visita_concretada){
			if (strtotime($schedule->fecha_visita_concretada) == strtotime($schedule->fecha_visita_programada)){
				return "success";
			} else {
				return "danger";
			}
		}
	}

}
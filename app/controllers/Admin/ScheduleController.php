<?php
class ScheduleController extends AdminController
{
    public $sectionName = "Agenda";

    public function saveScheduleCustomer()
    {
        $customer = Schedule::saveCustomerScheduleForThisWeek(Input::get('id'), Input::get('fecha_visita_programada'),
            Input::get('fecha_visita_concretada'), Input::get('id_vendedor'));
        return json_encode($customer);

    }

    public function getCustomerScheduled()
    {
        $sellerId = Input::get('id');
        $fromto = $this->getFromAndToFromFilters();
        $from = isset($fromto['from']) ? $fromto['from'] : null;
        $to = isset($fromto['to']) ? $fromto['to'] : null;
        $customers = Schedule::getCustomersScheduled($from,$to,$sellerId);
        $notScheduledCustomers = Schedule::getCustomersNotScheduled($customers,$sellerId);
        $days = DatesHelper::getDatesColumnsSchedule($from,$to);
        $days = $this->addCustomersToDays($days,$customers);
        return View::make('adm.agenda.listado')
            ->with('notScheduledCustomers',$notScheduledCustomers)
            ->with("from",$from)
            ->with("days",$days)
            ->with("sellerId", $sellerId)
            ->with("to",$to)
            ->with("customers", $customers)
            ->with("sectionName", $this->sectionName)
            ->with("subSectionName", $this->subSectionName);
    }

    public function getModel()
    {
        return new Schedule();
    }

    protected function getFromAndToFromFilters()
    {
        if (!Input::get('from')){
            $fromto = Schedule::getFromAndToFromThisWeek();
        } else {
            //$plusday allways a monday
            $plusday = date('Y-m-d', strtotime(Input::get('from') . ' +1 day'));
            $fromto = Schedule::getFromAndToFromThisWeek($plusday);
        }
        return $fromto;
    }

    protected function addCustomersToDays($days,$customers)
    {
        foreach ($customers as $index => $customer) {
            if (isset($days[$customer->fecha_visita_programada])){
                $days[$customer->fecha_visita_programada]['customers'][] = $customer;
            }
        }
        return $days;
    }

    public function deleteScheduleCustomer()
    {
        $id = Input::get('id');
        $date = Input::get('date');
        $schedule = Schedule::where('id_cliente', $id)
                  ->where('fecha_visita_programada', $date)->first();
        if($schedule){
            $schedule->delete();
        }
        return json_encode(true);

    }

    public function setDefaultCustomers()
    {
        $sellerId = Input::get('id');
        $from = Input::get('from');
        $to = Input::get('to');
        $customers = Schedule::getCustomersScheduled($from,$to,$sellerId);
        $notScheduledCustomers = Schedule::getCustomersNotScheduled($customers,$sellerId);
        foreach ($notScheduledCustomers as $index => $notScheduledCustomer) {
            $defaultDay = $notScheduledCustomer->dia_visita_defecto;
            if($defaultDay){
                if($defaultDay == 7){
                    $defaultDay = 0;
                }
                $day = date('Y-m-d', strtotime($from . " +{$defaultDay} day"));
                Schedule::saveCustomerScheduleForThisWeek($notScheduledCustomer->id, $day,null,$sellerId);
            }
        }
        return Redirect::to(UrlsAdm::getSchedule() . "?id={$sellerId}&from={$from}");
    }

    public function migrateCustomersToSellerFromDay()
    {
        $sellerIdFrom = Input::get('id_vendedor');
        $sellerIdTo = Input::get('id_vendedor_destino');
        $day = Input::get('fecha_desde');
        $dayTo = Input::get('fecha_hasta') ? Input::get('fecha_hasta') : $day;
        $schedules = Schedule::getCustomersScheduled($day,$day,$sellerIdFrom);
        $seller = User::find($sellerIdTo);
        if ($seller && $seller->isSeller()){
            foreach ($schedules as $index => $schedule) {
                Schedule::changeDayAndSellerToSchedule($schedule->id_agenda,$sellerIdTo,$dayTo);
            }
        }
    }
}
<?php
class ScheduleController extends AdminController
{

    public $subSectionName = "Agenda";

    public function saveScheduleCustomer()
    {
        $customer = Schedule::saveCustomerScheduleForThisWeek(Input::get('id'), Input::get('fecha_visita_programada'),
            Input::get('fecha_visita_concretada'));
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
        return View::make('adm.agenda.listado')
            ->with('notScheduledCustomers',$notScheduledCustomers)
            ->with("from",$from)
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
}
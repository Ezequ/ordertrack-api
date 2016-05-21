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
        $fromto = $this->getFromAndToFromFilters();
        $from = isset($fromto['from']) ? $fromto['from'] : null;
        $to = isset($fromto['to']) ? $fromto['to'] : null;
        $list = Schedule::getCustomersScheduled($from,$to,Input::get('id'));
        return View::make('adm.agenda.listado')
            ->with("from",$from)
            ->with("to",$to)
            ->with("customers", $list)
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
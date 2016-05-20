<?php
class ScheduleController extends AdminController
{

    public function saveScheduleCustomer()
    {
        Schedule::saveCustomerScheduleForThisWeek(Input::get('id'), Input::get('fecha_visita_programada'),
            Input::get('fecha_visita_concretada'));

    }

    public function getCustomerScheduled()
    {
        $list = Schedule::getCustomersScheduled(Input::get('from'),Input::get('to'),Input::get('id'));
        var_dump($list);
    }
    
    public function getModel()
    {
        return new Schedule();
    }
}
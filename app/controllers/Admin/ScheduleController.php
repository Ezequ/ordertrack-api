<?php
class ScheduleController extends AdminController
{

    public function saveScheduleCustomer()
    {
        $customer = Schedule::saveCustomerScheduleForThisWeek(Input::get('id'), Input::get('fecha_visita_programada'),
            Input::get('fecha_visita_concretada'));
        return json_encode($customer);

    }

    public function getCustomerScheduled()
    {
        $list = Schedule::getCustomersScheduled(Input::get('from'),Input::get('to'),Input::get('id'));
        return json_encode($list);
    }
    
    public function getModel()
    {
        return new Schedule();
    }
}
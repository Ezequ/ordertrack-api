<?php
class OrderStatesDefinition extends Definition
{
    public static function getDefinition()
    {
        return array(
            Order::ACTIVE_STATE => 'Activo',
            Order::CONFIRM_STATE => 'Confirmado',
            Order::BUILDING_STATE => 'Despachado',
            Order::SHIPPING_STATE => 'Enviado',
            Order::COMPLETED_STATE => 'Completado',
            Order::CANCELED_STATE => 'Cancelado',
        );
    }

    public static function getNextState($state)
    {
        $definition = self::getDefinition();
        if ($state == Order::COMPLETED_STATE){
            $nextState = null;
        } else {
            $nextState = array('id_estado' => $state+1 , 'nombre' => $definition[$state+1]);
        }
        return $nextState;
    }

    public static function getPreviousState($state)
    {
        $definition = self::getDefinition();
        if ($state == Order::ACTIVE_STATE){
            $nextState = null;
        } else {
            $nextState = array('id_estado' => $state-1 , 'nombre' => $definition[$state-1]);
        }
        return $nextState;
    }


}
<?php
class OrderStatesDefinition extends Definition
{
    public static function getDefinition()
    {
        return array(
            /*Order::ACTIVE_STATE => 'Activo',*/
            Order::CONFIRM_STATE => 'Confirmado',
            Order::BUILDING_STATE => 'Verificado',
           Order::SHIPPING_STATE => 'Despachado',
            Order::CANCELED_STATE => 'Cancelado',
           /* Order::COMPLETED_STATE => 'Completado',
            Order::CANCELED_STATE => 'Cancelado',*/
        );
    }

    public static function getActions()
    {
        return array(
            /*Order::ACTIVE_STATE => 'Activar',*/
            Order::CONFIRM_STATE => 'Confirmar',
            Order::BUILDING_STATE => 'Verificar',
            Order::SHIPPING_STATE => 'Despachar',
            Order::CANCELED_STATE => 'Cancelar',
        );
    }

    public static function getNextState($state)
    {
        $definition = self::getActions();
        if ($state == Order::SHIPPING_STATE || $state == Order::CANCELED_STATE){
            $nextState = null;
        } else {
            $nextState = array('id_estado' => $state+1 , 'nombre' => $definition[$state+1]);
        }
        return $nextState;
    }

    public static function getCancelState($state)
    {
        if ($state != Order::SHIPPING_STATE && $state != Order::CANCELED_STATE)
            return array('id_estado' => Order::CANCELED_STATE , 'nombre' => 'Cancelar');
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
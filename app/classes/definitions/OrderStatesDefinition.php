<?php
class OrderStatesDefinition extends Definition
{
    public static function getDefinition()
    {
        return array(
            Order::PENDING_STATE => 'Pendiente',
            Order::ACTIVE_STATE => 'Activo',
            Order::CANCELED_STATE => 'Cancelado',
            Order::COMPLETED_STATE => 'Completado',
            Order::CONFIRM_STATE => 'Confirmado',
            Order::BUILDING_STATE => 'Armandose',
            Order::SHIPPING_STATE => 'Enviándose',
        );
    }
}
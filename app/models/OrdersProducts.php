<?php
class OrdersProducts extends Eloquent
{
    protected $table = 'productos_ordenes';

    protected $fillable = ["id_orden", "id_producto", "cantidad"];


}
<?php

class Order extends Model{
	protected $fillable = ["id_cliente", "id_estado"];

	protected $table = "ordenes";

	protected $allowedFilters = array('id_vendedor',  'estado');

	public static function getList($filters = array())
	{
		$model = new self;
		return $model->_getList($filters);
	}

	public static function getProductsByOrder($id)
	{
		$productsOrder = DB::table('ordenes')
			->where('ordenes.id', $id)
			->leftJoin('productos_ordenes', 'ordenes.id', '=', 'productos_ordenes.id_orden')
			->get();
		return $productsOrder;
	}
}
<?php

class Order extends Model{
	protected $fillable = ["id_cliente", "id_estado", "comentarios"];

	protected $table = "ordenes";

	protected $allowedFilters = array('id_vendedor',  'estado');

	const PENDING_STATE = 0;
	const ACTIVE_STATE = 1;
	const CANCELED_STATE = 2;
	const COMPLETED_STATE = 3;


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
			->leftJoin('productos', 'productos_ordenes.id_producto', '=', 'productos.id')
			->whereNotNull('productos.id')
			->get();
		return $productsOrder;
	}

	public static function addProductToOrder($data)
	{
		if(Order::find($data['id_orden']) && Product::find($data['id_producto']) && $data['cantidad'] > 0)
		{
			if($model = OrdersProducts::where('id_orden', $data['id_orden'])->where('id_producto', $data['id_producto'])->first()){
				$model->update(array('cantidad' => $data['cantidad']));
				$result = $model;
			} else {
				$result = OrdersProducts::create($data);
			}
			return $result;
		} else {
			throw(new Exception('error al agregara producto a la orden'));
		}
	}

	public function confirmOrder($order)
	{
		$products = self::getProductsByOrder($order->id);
		$productsError = array();
		foreach ($products as $index => $product) {
			if($product->cantidad > $product->stock){
				$productsError[] = $product->nombre;
			}
		}
		if(count($productsError) > 0){
			$errors = "Los siguientes productos superan al stock pedido: ";
			$stringProducts = implode(" , ", $productsError);
			return $errors . $stringProducts;
		} else {
			$order->id_estado = Order::COMPLETED_STATE;
			$order->save();
			return "";
		}
	}
}
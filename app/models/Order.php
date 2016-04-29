<?php

class Order extends Model{
	protected $fillable = ["id_cliente", "id_estado", "comentarios", "id_vendedor", 'fecha_confirmacion'];

	protected $table = "ordenes";

	protected $allowedFilters = array('id_vendedor',  'id_estado', 'id_cliente','fecha_confirmacion');

	const ACTIVE_STATE = 1;
	const CONFIRM_STATE = 2;
	const BUILDING_STATE = 3;
	const SHIPPING_STATE = 4;
	const COMPLETED_STATE = 5;
	const CANCELED_STATE = 6;



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

	public function confirmOrder($force = false)
	{
		$products = self::getProductsByOrder($this->id);
		$productsError = array();
		foreach ($products as $index => $product) {
			if($product->cantidad > $product->stock){
				$productsError[] = $product->nombre;
			}
		}
		$existsErrors = count($productsError) > 0;
		if($existsErrors) {
			$errors = "Los siguientes productos superan al stock pedido: ";
			$stringProducts = implode(" , ", $productsError);
			$this->comentarios = $errors . $stringProducts;
		}
		if(!$existsErrors || $force){
			$this->fecha_confirmacion = date("Y-m-d H:i:s");
			$this->id_estado = Order::CONFIRM_STATE;
		}
		$this->save();
	}

	public function getFiltersForList()
	{
		$inputs[] = array("type" => 'select', 'data1' => 'Estado', 'data2' => 'id_estado', 'data3' => OrderStatesDefinition::getDefinition(), 'data4' => Input::get('id_estado'));
		$inputs[] = array("type" => 'select', 'data1' => 'Cliente', 'data2' => 'id_cliente', 'data3' => ClientsDefinition::getDefinition(), 'data4' => Input::get('id_cliente'));
		return $inputs;
	}

	// !$before => $after
	public function getStateButton($before = true)
	{
		$state = OrderStatesDefinition::getIdByName($this->id_estado);
		if ($before){
			return OrderStatesDefinition::getPreviousState($state);
		} else {
			return OrderStatesDefinition::getNextState($state);
		}
	}


}
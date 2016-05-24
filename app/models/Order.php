<?php

class Order extends Model{
	protected $fillable = ["id_cliente", "id_estado", "comentarios", "id_vendedor", 'fecha_confirmacion'];

	protected $table = "ordenes";

	protected $allowedFilters = array('id_vendedor',  'id_estado', 'id_cliente','fecha_confirmacion');

	const ACTIVE_STATE = 1;
	const CONFIRM_STATE = 2;
	const BUILDING_STATE = 3;
	const SHIPPING_STATE = 4;
	const CANCELED_STATE = 5;



	public static function getProductsByOrder($id)
	{
		$productsOrder = DB::table('ordenes')
			->where('ordenes.id', $id)
			->leftJoin('productos_ordenes', 'ordenes.id', '=', 'productos_ordenes.id_orden')
			->leftJoin('productos', 'productos_ordenes.id_producto', '=', 'productos.id')
			->whereNotNull('productos.id')
			->get();
		$productsOrder = self::setSubtotals($productsOrder);
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
		$productsError = $this->checkStocks($products);
		$existsErrors = count($productsError) > 0;
		if($existsErrors) {
			$errors = "Los siguientes productos superan al stock pedido: ";
			$stringProducts = implode(" , ", $productsError);
			$this->comentarios = $errors . $stringProducts;
		}
		if(!$existsErrors || $force){
			$this->fecha_confirmacion =	date('Y-m-d H:i:s',strtotime ( '-3 hour' , strtotime ( date("Y-m-d H:i:s") ) ));
			$client = Client::find($this->id_cliente);
			if($client){
				$client->fecha_ultima_visita = date('Y-m-d H:i:s',strtotime ( '-3 hour' , strtotime ( date("Y-m-d H:i:s") ) ));
				$client->save();
			}
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
			return OrderStatesDefinition::getCancelState($state);
		} else {
			return OrderStatesDefinition::getNextState($state);
		}
	}

	public function updateStock()
	{
		$products = self::getProductsByOrder($this->id);
		$productsError = $this->checkStocks($products);
		$existsErrors = count($productsError) > 0;
		if($existsErrors) {
			$errors = "No se puede verificar el pedido N°{$this->id} ya que los siguientes productos superan al stock pedido: ";
			$stringProducts = implode("", $productsError);
			return $errors . $stringProducts;
		} else {
			foreach ($products as $index => $product) {
				$productModel = Product::find($product->id);
				if ($productModel){
					$productModel->stock = $productModel->stock - $product->cantidad;
					$productModel->save();
				}
			}
		}
		return "";
	}

	protected function checkStocks($products)
	{
		$productsError = array();
		foreach ($products as $index => $product) {
			if($product->cantidad > $product->stock){
				$productsError[] = "\n* " . $product->nombre . " - " . $product->marca;
			}
		}
		return $productsError;
	}

	public static function setSubtotals($ordersProduct)
	{
		$returnOrderProducts = array();
		foreach ($ordersProduct as $index => $item) {
			$discountNumber = Product::getDiscount($item->cantidad,$item->descuento_1_min,$item->descuento_2_min,$item->descuento_3_min,$item->descuento_4_min,$item->descuento_5_min);
			$discount = $item->$discountNumber;
			$item->subtotal_sin_descuento = $item->cantidad * $item->precio;
			$item->descuento_realizado = $item->subtotal_sin_descuento * ($discount) / 100;
			$item->subtotal_con_descuento = $item->subtotal_sin_descuento - $item->descuento_realizado;
			$returnOrderProducts[] = $item;
		}
		return $returnOrderProducts;
	}

}
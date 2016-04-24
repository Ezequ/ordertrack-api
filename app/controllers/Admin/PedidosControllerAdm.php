<?php /**
* 
*/
class PedidosControllerAdm extends AdminController
{
	public $name = "pedido";

	public function getListado()
	{
		/* nombre acciones habilitadas*/
		$buttons = array('detalle' => null);
		/* nombre => campo en base de datos	*/
		$fields = array('id' => 'id', 'Cliente' => 'id_cliente', 'Estado' => 'id_estado', 'Comentarios' => 'comentarios' );
		/*	listar(campos,nombre,botones,vista,tamtabla);	*/
		return parent::getList($fields,$buttons,"",'12');
	}

	public function getModel()
	{
		return new Order();
	}

	public function getObjectsToList()
	{
		$objects = $this->getModel()->getList(Input::all());
		$objects = ClientsDefinition::convertObjectListFieldToDefinition($objects,'id_cliente');
		$objects = OrderStatesDefinition::convertObjectListFieldToDefinition($objects, 'id_estado');
		return $objects;
	}

	public function getDetalle($id)
	{
		$order = Order::find($id);
		if ($order){
			$order = ClientsDefinition::convertObjectFieldToDefinition($order,'id_cliente');
			$order = OrderStatesDefinition::convertObjectFieldToDefinition($order, 'id_estado');
			$products = $order->getProductsByOrder($order->id);
			return View::make('adm.pedidos.detalle')
					->with('products',$products)
					->with('order', $order);
		} else {
			return \Illuminate\Support\Facades\Redirect::back()->with('message',"No se encuentra el pedido")->with('result',false);
		}
	}

}
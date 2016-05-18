<?php /**
* 
*/
class PedidosControllerAdm extends AdminController
{
	protected $sectionName =  "Pedidos";
	protected $subSectionName =  "Listado de pedidos";

	public $name = "pedido";
	protected $nameList =  "pedidos";

	public function getListado()
	{
		/* nombre acciones habilitadas*/
		$buttons = array('detalle' => null);
		/* nombre => campo en base de datos	*/
		$fields = array('id' => 'id', 'Cliente' => 'id_cliente', 'Vendedor' => 'id_vendedor' ,'Estado' => 'id_estado', 'Fecha de confirmación' => 'fecha_confirmacion' );
		/*	listar(campos,nombre,botones,vista,tamtabla);	*/
		return parent::getList($fields,$buttons,"adm.pedidos.listado",'12');
	}

	public function getModel()
	{
		return new Order();
	}

	public function getObjectsToList()
	{
		$objects = $this->getFilteredOrders();
		$objects = ClientsDefinition::convertObjectListFieldToDefinition($objects,'id_cliente');
		$objects = OrderStatesDefinition::convertObjectListFieldToDefinition($objects, 'id_estado');
		$objects = SellerDefinition::convertObjectListFieldToDefinition($objects, 'id_vendedor');
		return $objects;
	}

	public function getDetalle($id)
	{
		$order = Order::find($id);
		if ($order){
			$order = ClientsDefinition::convertObjectFieldToDefinition($order,'id_cliente');
			$order = OrderStatesDefinition::convertObjectFieldToDefinition($order, 'id_estado');
			$products = $order->getProductsByOrder($order->id);
			$view = View::make('adm.pedidos.detalle')
					->with('products',$products)
					->with('order', $order);
			return $view;
		} else {
			return \Illuminate\Support\Facades\Redirect::back()->with('message',"No se encuentra el pedido")->with('result',false);
		}
	}

	public function index()
	{
		return View::make('adm.templates.template2');
	}


	public function changeStatus()
	{
		$order = Order::find(Input::get('id'));
		if($order){
			$order->id_estado = Input::get('status');
			if(Input::get('status') == Order::CONFIRM_STATE){
				$order->fecha_confirmacion =	date('Y-m-d H:i:s',strtotime ( '-3 hour' , strtotime ( date("Y-m-d H:i:s") ) ));
			}
			if (Input::get('status') == Order::BUILDING_STATE){
				$result = $order->updateStock();
				if ($result != ""){
					return $result;
				}
			}
			$order->save();
		}
		return "";
	}

	public function getFilteredOrders()
	{
		$filters = Input::all();
		$orderProductsFilters = OrdersProducts::getList($filters);
		$ids = array();
		foreach ($orderProductsFilters as $index => $orderProduct) {
			$ids[] = $orderProduct->id;
		}
		$order = Order::whereIn('id', $ids)
			->where('id_estado', '<>', Order::ACTIVE_STATE);

		if (Auth::user()->isSeller()){
			$order->where('id_vendedor', Auth::user()->id);
		}
		$order->orderBy(Input::get('orderby', 'fecha_confirmacion'), Input::get('orientation','desc'));
		return $order->paginate(Model::PAGINATOR);
	}

}
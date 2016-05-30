<?php
use Illuminate\Support\Facades\Response as Response;
class OrdersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /orders
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = Order::getList(Input::all());
		return $orders->toJson();
	}

	public function getProductsByOrder()
	{
		if($id = Input::get('id'))
		{
			$orders = Order::getProductsByOrder($id);
			return json_encode($orders);
		} else {
			return Response::make('No se encontró la orden', 500);
		}
	}


	public function addProductToOrder()
	{
		if($id = Input::get('id_orden'))
		{
			$data['id_orden'] = $id;
			$data['id_producto'] = Input::get('id_producto');
			$data['cantidad'] = Input::get('cantidad') ? (int)Input::get('cantidad') : 0;
			$rules = [
				'cantidad'    => 'min:1',
				'id_orden' => 'required',
				'id_producto' => 'required'
			];
			$validator = Validator::make($data, $rules);
			if($validator->passes()) {
				$orderProduct = Order::addProductToOrder($data);
				return $orderProduct->toJson();
			} else {
				return Response::make($validator->getMessages(), 500);
			}
		} else {
			return Response::make('Error', 500);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /orders/create
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /orders
	 *
	 * @return Response
	 */
	public function store()
	{
		$today = date('Y-m-d',strtotime ( '-3 hour' , strtotime ( date("Y-m-d H:i:s") ) ));
		$data = Input::all();
		$order = Order::create($data);
		if($order){
			$idCustomer = $order->id_cliente;
			$fromto = Schedule::getFromAndToFromThisWeek();
			Schedule::where('id_cliente',$idCustomer)
						->where('fecha_visita_programada', "<=", $fromto['to'])
						->whereNull('fecha_visita_concretada')
						->update(array('fecha_visita_concretada' => $today, 'id_orden' => $order->id, 'pedido_hecho' => true));
			return json_encode($order);
		} else {
			return Response::make('No se encontró la orden', 500);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Order::findOrFail($id)->toJson();
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /orders/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getActiveProductOrder($id)
	{
		$order = Order::where('id_cliente', $id)
			->where(function($query)
			{
				$query->orWhere('id_estado', Order::ACTIVE_STATE);
			})
			->orderBy('updated_at', 'desc')
			->first();
		if ($order) {
			return $order->toJson();
		} else {
			$order = Order::where('id_cliente', $id)
				->where(function($query)
				{
					$query->orWhere('id_estado', Order::CONFIRM_STATE);
				})
				->orderBy('updated_at', 'desc')
				->first();
			if ($order){
				return $order->toJson();
			} else {
				return Response::make('No se encontró la orden', 500);
			}
		}
	}

	public function getProductsFromActiveOrder($id)
	{
		$order = json_decode($this->getActiveProductOrder($id));
		if ($order) {
			$orders = Order::getProductsByOrder($order->id);
			return json_encode($orders);
		} else
		{
			return json_encode(array());
		}
	}

	public function removeProductFromOrder()
	{
		$orderId = Input::get('id_orden');
		$productId = Input::get('id_producto');
		DB::table('productos_ordenes')
			->where('id_orden',$orderId)
			->where('id_producto',$productId)
			->delete();
		$left = Order::find($orderId);
		if($left)
		{
			return $this->getProductsFromActiveOrder($left->id_cliente);
		} else {
			return json_encode(array());
		}
	}

	public function confirmOrder($id)
	{
		$force = Input::get('force', false);
		$order = Order::findOrFail($id);
		$order->confirmOrder($force);
		return $order->toJson();
	}
}
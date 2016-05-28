<?php
use Faker\Factory as Faker;
class ReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Client::findOrFail($id)->toJson();
	}


	/**
	 * Show the form for editing the specified resource.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	// Especials functions //

	public function getReport($id)
	{	

		$today = date('Y-m-d',strtotime ( '-3 hour' , strtotime ( date("Y-m-d H:i:s") ) ));
		$tomorrow = date('Y-m-d',strtotime ( '+1 day' , strtotime ( $today ) ));


		$query = DB::table('agenda')->where('id_vendedor',$id);
		$query->where('fecha_visita_concretada', "=", $today);
		$query->where('fecha_visita_programada', "=", $today);
		$clientsOnRoute = $query->count();

		$query = DB::table('agenda')->where('id_vendedor',$id);
		$query->where('fecha_visita_concretada', "=", $today);
		$query->where('fecha_visita_programada', "<>", $today);
		$clientsNotOnRoute = $query->count();

		$totalProductos = DB::table('ordenes')
			->where('ordenes.id_vendedor', $id)
			->leftJoin('productos_ordenes', 'ordenes.id', '=', 'productos_ordenes.id_orden')
			->leftJoin('productos', 'productos_ordenes.id_producto', '=', 'productos.id')
			->whereNotNull('productos.id')
			->where('ordenes.fecha_confirmacion', ">=", $today)
			->where('ordenes.fecha_confirmacion', "<", $tomorrow)
			->sum('productos_ordenes.cantidad');

		$totalMoney = DB::table('ordenes')
			->where('ordenes.id_vendedor', $id)
			->where('ordenes.fecha_confirmacion', ">=", $today)
			->where('ordenes.fecha_confirmacion', "<", $tomorrow)
			->sum('total');


		$report = array(
			'clientsOnRoute'      => $clientsOnRoute,
			'clientsNotOnRoute'  => $clientsNotOnRoute,
			'totalProductos'	=> $totalProductos,
			'totalMoney'  => $totalMoney,
 		);

 		PushNotification::app('fiuba-order-tracker')
                ->to("758199789160")
                //->to("fiuba-order-tracker")
                ->send('Hello World, i`m a push message');

		return Response::json($report);
	}

}

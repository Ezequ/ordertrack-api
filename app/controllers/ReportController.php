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
		$today = date('Y-m-d');
		$query = DB::table('agenda')->join('clientes', 'agenda.id_cliente', '=', 'clientes.id');
		$query->where('fecha_visita_concretada', "=", $today);
		$query->where('fecha_visita_programada', "=", $today);
		if ($id){
			$query->where('id_vendedor',$id);
		}
		$clientsOnRoute = $query->count();

		$query = DB::table('agenda')->join('clientes', 'agenda.id_cliente', '=', 'clientes.id');
		$query->where('fecha_visita_concretada', "=", $today);
		$query->where('fecha_visita_programada', "<>", $today);
		if ($id){
			$query->where('id_vendedor',$id);
		}
		$clientsNotOnRoute = $query->count();

		$totalProductos = DB::table('ordenes')
			->where('ordenes.id_vendedor', $id)
			->leftJoin('productos_ordenes', 'ordenes.id', '=', 'productos_ordenes.id_orden')
			->leftJoin('productos', 'productos_ordenes.id_producto', '=', 'productos.id')
			->whereNotNull('productos.id')
			->where('ordenes.fecha_confirmacion', "=", $today)
			->sum('productos_ordenes.cantidad');

		$totalMoney = DB::table('ordenes')
			->where('ordenes.id_vendedor', $id)
			->where('ordenes.fecha_confirmacion', "=", $today)
			->sum('total');


		$report = array(
			'clientsOnRoute'      => $clientsOnRoute,
			'clientsNotOnRoute'  => $clientsNotOnRoute,
			'totalProductos'	=> $totalProductos,
			'totalMoney'  => $totalMoney
		);

		return Response::json($report);
	}

}

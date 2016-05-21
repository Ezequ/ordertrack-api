<?php
use Faker\Factory as Faker;
class ClientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Input::all();

		if (!isset($data['fecha_visita'])){
			$data['fecha_visita'] = null;	
		}

		$query = Schedule::getCustomersScheduled($data['fecha_visita'],$data['fecha_visita'],$data['id_vendedor'],false);
		
		if (isset($data['razon_social%'])){
			$query->where('razon_social', 'LIKE', '%'.$data['razon_social%'].'%');
		}

		if (isset($data['cod_cliente%'])){
			$query->where('cod_cliente', 'LIKE', '%'.$data['cod_cliente%'].'%');
		}

		if (isset($data['orderby'])){
			$orientation = isset($data['orientation']) ? $data['orientation'] : 'asc';
			$query = $query->orderBy($orderBy,$orientation);
		}
		
		
		$clients = $query->where('estado','>=',ClientsStatesDefinition::STATE_NORMAL)->get();


		return Response::json($clients);
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

	public function getFromToday($sellerId)
	{
		$today = date('Y-m-d');
		$clients = Client::where('id_vendedor',$sellerId)
				->where('fecha_visita', $today)
				->where('estado','>=',ClientsStatesDefinition::STATE_NORMAL)
				->get();
		return $clients->toJson();
	}

}

<?php

class Client extends Model {
	protected $fillable = ['apenom', 'direccion','telefono', 'observaciones','id_vendedor','fecha_visita',
							'razon_social', 'cod_cliente', 'fecha_ultima_visita','estado'];

	protected $table = "clientes";

	protected $allowedFilters = array('apenom', 'direccion','telefono', 'observaciones','id_vendedor','fecha_visita',
		'razon_social', 'cod_cliente', 'estado');

	public $timestamps = false;

	public function getFechaVisitaAttribute($value)
	{
		$date = date_create($value);
		return date_format($date,"d-m-Y");
	}

	public function getInputsForEdit()
	{
		$inputs[] = array("type" => 'common', 'data1' => 'Razón social', 'data2' => 'razon_social', 'data3' => $this->razon_social);
		$inputs[] = array("type" => 'common', 'data1' => 'Dirección', 'data2' => 'direccion', 'data3' => $this->direccion);
		$inputs[] = array("type" => 'common', 'data1' => 'Teléfono', 'data2' => 'telefono', 'data3' => $this->telefono);
		$inputs[] = array("type" => 'select', 'data1' => 'Vendedor', 'data2' => 'id_vendedor', 'data3' => SellerDefinition::getDefinition(), 'data4' => $this->id_vendedor);
		$inputs[] = array("type" => 'common', 'data1' => 'Código cliente', 'data2' => 'cod_cliente', 'data3' => $this->cod_cliente);
		$inputs[] = array("type" => 'text', 'data1' => 'Observaciones', 'data2' => 'observaciones', 'data3' => $this->observaciones);
		$inputs[] = array("type" => 'hidden', 'data1' => 'estado', 'data2' => ClientsStatesDefinition::STATE_NORMAL);
		return $inputs;
	}

	/**
	 * Listen for save event
	 */
	protected static function boot()
	{
		parent::boot();

		static::saving(function($model)
		{
			$latlong = self::getLatLong($model->direccion);
			if ($latlong){
				$model->latitud = $latlong['lat'];
				$model->longitud = $latlong['long'];
			}
		});

		static::updating(function($model)
		{
			$latlong = self::getLatLong($model->direccion);
			if ($latlong){
				$model->latitud = $latlong['lat'];
				$model->longitud = $latlong['long'];
			}
		});
	}

	static function getLatLong($address){

		$address = str_replace(" ", "+", $address);
		$region = "Buenos Aires";
		$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=" . urlencode($address) .
			"&sensor=false&region=" . urlencode($region));
		$json = json_decode($json);
		$return = array();
		try{
			$return['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
			$return['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		} catch(Exception $e) {
			$return = null;
		}
		return $return;
	}
	
}
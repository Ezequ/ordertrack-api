<?php

class Client extends Model {
	protected $fillable = ['apenom', 'direccion','telefono', 'observaciones','id_vendedor','fecha_visita',
							'razon_social', 'cod_cliente', 'fecha_ultima_visita'];

	protected $table = "clientes";

	protected $allowedFilters = array('apenom', 'direccion','telefono', 'observaciones','id_vendedor','fecha_visita',
		'razon_social', 'cod_cliente');

	public $timestamps = false;

	public function getFechaVisitaAttribute($value)
	{
		$date = date_create($value);
		return date_format($date,"d-m-Y");
	}
	
}
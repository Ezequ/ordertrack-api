<?php

class Discount extends Model {
	protected $fillable = ['fecha_inicio', 'fecha_fin', 'sin_limites', 'cant_bultos_min', 'cant_bultos_max','descripcion','descuento'];

	protected $table = 'descuentos';

	protected $allowedFilters = array('fecha_inicio','fecha_fin');

	public static $rules = array(
		'cant_bultos_min'             => 'required',
	);
	/*
	public function getInputsForEdit()
	{
		$inputs[] = array("type" => 'common', 'data1' => 'Nombre', 'data2' => 'nombre', 'data3' => $this->nombre);
		$inputs[] = array("type" => 'common', 'data1' => 'Descripción', 'data2' => 'descripcion', 'data3' => $this->descripcion);
		return $inputs;
	}
*//*
	public static function getForSelect()
	{
		$categorias = self::getList(array());
		$catSelect = array();
		foreach ($categorias as $key => $value) {
			$catSelect[$value->id] = $value->nombre;
		}
		return $catSelect;
	}
*/

}
<?php

class Category extends Model {
	protected $fillable = ['nombre', 'activo', 'descripcion'];

	protected $table = 'categorias';

	protected $allowedFilters = array('nombre');

	public static $rules = array(
		'nombre'             => 'required',
	);

	public function getInputsForEdit()
	{
		$inputs[] = array("type" => 'common', 'data1' => 'Nombre', 'data2' => 'nombre', 'data3' => $this->nombre);
		$inputs[] = array("type" => 'common', 'data1' => 'Descripción', 'data2' => 'descripcion', 'data3' => $this->descripcion);
		return $inputs;
	}

	public static function getForSelect()
	{
		$categorias = self::getList(array());
		$catSelect = array();
		foreach ($categorias as $key => $value) {
			$catSelect[$value->id] = $value->nombre;
		}
		return $catSelect;
	}


}
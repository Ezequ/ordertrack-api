<?php

class Category extends Model {
	protected $fillable = ['nombre', 'activo', 'descripcion'];

	protected $table = 'categorias';

	protected $allowedFilters = array('nombre');

	public function getInputsForEdit()
	{
		$inputs[] = array("type" => 'common', 'data1' => 'Nombre', 'data2' => 'nombre', 'data3' => $this->nombre);
		$inputs[] = array("type" => 'common', 'data1' => 'Descripción', 'data2' => 'descripcion', 'data3' => $this->descripcion);
		$inputs[] = array("type" => 'hidden', 'data1' => 'activo', 'data2' => 0);
		$inputs[] = array("type" => 'checkbox', 'data1' => 'Habilitado', 'data2' => 'activo', 'data3' => 1,'data4' => $this->activo, 'data4' => $this->activo);
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
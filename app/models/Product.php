<?php

class Product extends Model {
	protected $fillable = ['nombre','descripcion', 'marca', 'categoria', 'stock', 'precio', 'url_image_tumbnail', 'url_image_mini'];

	protected $table = 'productos';

	public static $rules = array(
		'stock'             => 'required|integer|min:1',
		'precio'             => 'required|integer|min:1',
		'categoria'             => 'required|not_in:0',
		'nombre'             => 'required',
	);

	protected $allowedFilters = array('categoria', 'descripcion', 'marca', 'stock', 'precio','nombre');

	public static $messages = array(
		'min'			=> 'El valor del :atribute debe ser mínimo 1',
		'integer'			=> 'El valor del :atribute debe ser un entero',
		'required'      => 'El campo :attribute es requerido.',
		'categoria.not_in'	=> 'La categoría asignada es inválida.',
	);

	public function getInputsForEdit()
	{
		$inputs[] = array("type" => 'select', 'data1' => 'Categoría', 'data2' => 'categoria', 'data3' => Category::getForSelect(), 'data4' => $this->categoria);
		$inputs[] = array("type" => 'common', 'data1' => 'Nombre', 'data2' => 'nombre', 'data3' => $this->nombre);
		$inputs[] = array("type" => 'common', 'data1' => 'Marca', 'data2' => 'marca', 'data3' => $this->marca);
		$inputs[] = array("type" => 'common', 'data1' => 'Precio', 'data2' => 'precio', 'data3' => $this->precio);
		$inputs[] = array("type" => 'common', 'data1' => 'Stock', 'data2' => 'stock', 'data3' => $this->stock);
		$inputs[] = array("type" => 'common', 'data1' => 'Descripción', 'data2' => 'descripcion', 'data3' => $this->descripcion);
		return $inputs;
	}

	public static function getDiscount($cant,$d1 = 0, $d2 = 0, $d3 = 0, $d4 = 0, $d5 = 0)
	{
		$disc["descuento_1"] = $d1;$disc["descuento_2"] = $d2;$disc["descuento_3"] = $d3;$disc["descuento_4"] = $d4;$disc["descuento_5"] = $d5;
		asort($disc);
		$cant = (int)$cant;
		foreach ($disc as $index => $item) {
			if ($cant > (int)$item){
				continue;
			} else {
				return $index;
			}
		}
		return $index;
	}

	public function cmp($a, $b)
	{
		if ($a == $b) {
			return 0;
		}
		return ($a < $b) ? -1 : 1;
	}



}
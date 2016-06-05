<?php

class Product extends Model {
	protected $fillable = ['nombre','descripcion', 'marca', 'categoria', 'stock',
							'precio', 'url_image_tumbnail', 'url_image_mini','url_image_normal','descuento_2','descuento_2_min',
							'descuento_1','descuento_1_min','descuento_3','descuento_3_min',
						'descuento_4','descuento_4_min','descuento_5','descuento_5_min',];

	protected $table = 'productos';

	public static $rules = array(
		'stock'                   => 'required|integer|min:1',
		'precio'                  => 'required|integer|min:1',
		'descuento_1'             => 'integer|max:100',
		'descuento_2'             => 'integer|max:100',
		'descuento_3'             => 'integer|max:100',
		'descuento_4'             => 'integer|max:100',
		'descuento_5'             => 'integer|max:100',
		'descuento_1_min'         => 'integer',
		'descuento_2_min'         => 'integer',
		'descuento_3_min'         => 'integer',
		'descuento_4_min'         => 'integer',
		'descuento_5_min'         => 'integer',
		'categoria'               => 'required|not_in:0',
		'nombre'                  => 'required',
	);

	protected $allowedFilters = array('categoria', 'descripcion', 'marca', 'stock', 'precio','nombre');

	public static $messages = array(
		'min'			=> 'El valor del :attribute debe ser mínimo 1',
		'integer'			=> 'El valor del :attribute debe ser un entero',
		'required'      => 'El campo :attribute es requerido.',
		'categoria.not_in'	=> 'La categoría asignada es inválida.',
		'max'		=> "El porcentaje no puede superar al 100%"
	);

	public function getInputsForEdit()
	{
		$inputs[] = array("type" => 'select', 'data1' => 'Categoría', 'data2' => 'categoria', 'data3' => Category::getForSelect(), 'data4' => $this->categoria);
		$inputs[] = array("type" => 'common', 'data1' => 'Nombre', 'data2' => 'nombre', 'data3' => $this->nombre);
		$inputs[] = array("type" => 'common', 'data1' => 'Marca', 'data2' => 'marca', 'data3' => $this->marca);
		$inputs[] = array("type" => 'common', 'data1' => 'Precio', 'data2' => 'precio', 'data3' => $this->precio);
		$inputs[] = array("type" => 'common', 'data1' => 'Stock', 'data2' => 'stock', 'data3' => $this->stock);
		$inputs[] = array("type" => 'common', 'data1' => 'Descripción', 'data2' => 'descripcion', 'data3' => $this->descripcion);
		$inputs[] = array("type" => 'common', 'data1' => 'Imagen normal', 'data2' => 'url_image_normal', 'data3' => $this->url_image_normal);
		$inputs[] = array("type" => 'common', 'data1' => 'Imagen mini', 'data2' => 'url_image_mini', 'data3' => $this->url_image_mini);

		$list[] = array("type" => 'text', 'text' => '1');
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_1', 'data3' => $this->descuento_1);
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_1_min', 'data3' => $this->descuento_1_min);

		$list[] = array("type" => 'text', 'text' => '2');
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_2', 'data3' => $this->descuento_2);
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_2_min', 'data3' => $this->descuento_2_min);

		$list[] = array("type" => 'text', 'text' => '3');
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_3', 'data3' => $this->descuento_3);
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_3_min', 'data3' => $this->descuento_3_min);

		$list[] = array("type" => 'text', 'text' => '4');
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_4', 'data3' => $this->descuento_4);
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_4_min', 'data3' => $this->descuento_4_min);

		$list[] = array("type" => 'text', 'text' => '5');
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_5', 'data3' => $this->descuento_5);
		$list[] = array("type" => 'common_simple', 'data1' => '', 'data2' => 'descuento_5_min', 'data3' => $this->descuento_5_min);

		$inputs[] = array('type' => 'list', 'title' => 'Descuentos', 'extra' => array('columns' => 3, 'column_width' => '4', 'headers' => array('Num.', '% de descuento', 'Cantidad mínima')), 'data' => $list);

		return $inputs;
	}

	public static function getDiscount($cant,$d1 = 0, $d2 = 0, $d3 = 0, $d4 = 0, $d5 = 0)
	{
		$disc["descuento_1"] = $d1;$disc["descuento_2"] = $d2;$disc["descuento_3"] = $d3;$disc["descuento_4"] = $d4;$disc["descuento_5"] = $d5;
		asort($disc);
		$cant = (int)$cant;
		$apply_index = null;
		foreach ($disc as $index => $item) {
			if ($cant >= (int)$item){
				$apply_index = $index;
			}
		}
		return $apply_index;
	}

	public function cmp($a, $b)
	{
		if ($a == $b) {
			return 0;
		}
		return ($a < $b) ? -1 : 1;
	}



}

<?php

class Product extends Model {
	protected $fillable = ['nombre','descripcion', 'marca', 'categoria', 'stock', 'precio', 'url_image_tumbnail', 'url_image_mini'];

	protected $table = 'productos';

	protected $allowedFilters = array('categoria', 'descripcion', 'marca', 'stock', 'precio','nombre');


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



}
<?php


class DescuentosTableSeeder extends Seeder {

	public function run()
	{
		Discount::create([
			'sin_limites' 	=> 'true',
			'descripcion' 	=> 'Descuento entre 0 y 30 unidades: 3%',
			'cant_bultos_min' => 0,
			'cant_bultos_max' => 30,
			'descuento' => 3,
		]);

		Discount::create([
			'sin_limites' 	=> 'true',
			'descripcion' 	=> 'Descuento entre 31 y 60 unidades: 5%',
			'cant_bultos_min' => 31,
			'cant_bultos_max' => 60,
			'descuento' => 5,
		]);

		Discount::create([
			'sin_limites' 	=> 'true',
			'descripcion' 	=> 'Descuento mas de 60 unidades: 7%',
			'cant_bultos_min' => 61,
			'descuento' => 7,
		]);
	}

}
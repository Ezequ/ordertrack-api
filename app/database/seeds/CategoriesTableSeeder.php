<?php

use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$categories = $this->getCategoriesToSeed();
		foreach($categories as $category)
		{
			Category::create([
				'nombre' => $category['nombre'],
				'activo' => $category['activo'],
				'descripcion' 	=> $faker->paragraph()
			]);
		}
	}

	private function getCategoriesToSeed()
	{
		return array(
			array('nombre' => 'Almacén', 'activo' => '1'),
			array('nombre' => 'Frescos', 'activo' => '1'),
			array('nombre' => 'Bebidas', 'activo' => '1'),
			array('nombre' => 'Perfumería', 'activo' => '1'),
			array('nombre' => 'Limpieza', 'activo' => '1'),
			array('nombre' => 'Bebes y Mamás', 'activo' => '1'),
			array('nombre' => 'Tecnología', 'activo' => '1'),
			array('nombre' => 'Electrodomésticos', 'activo' => '1'),
			array('nombre' => 'Hogar y Bazar', 'activo' => '1'),
			array('nombre' => 'Juguetería', 'activo' => '1'),
			array('nombre' => 'Librería y Ocio', 'activo' => '1'),
			array('nombre' => 'Automotor y Ferretería', 'activo' => '1'),
			array('nombre' => 'Ropa y Calzados', 'activo' => '1'),
		);
	}

}
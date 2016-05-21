<?php
use Faker\Factory as Faker;

class ClientTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 50) as $index)
		{
			DB::table('clientes')->insert(array(
				'apenom' => $faker->name,
				'direccion' => $faker->address,
				'telefono' =>  $faker->phoneNumber,
				'observaciones' => $faker->paragraph(),
				'id_vendedor' => rand(1,2),
				'dia_visita_defecto' => rand(1,7),
			));
		}
	}

}
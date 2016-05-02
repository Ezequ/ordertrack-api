<?php
use Faker\Factory as Faker;

class ClientTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 100) as $index)
		{
			DB::table('clientes')->insert(array(
				'apenom' => $faker->name,
				'direccion' => $faker->address,
				'telefono' =>  $faker->phoneNumber,
				'observaciones' => $faker->paragraph(),
				'id_vendedor' => rand(1,5),
				'fecha_visita' => date('Y-m-d', strtotime('+' . rand(0,6).' days')),
			));
		}
	}

}
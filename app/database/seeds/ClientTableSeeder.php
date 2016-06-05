<?php
use Faker\Factory as Faker;

class ClientTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create('es_AR');

		foreach(range(1, 50) as $index)
		{
			$lat = rand(0,10000) / 1000000;
			$long = rand(0,10000) / 1000000;
			$lat = -34.6031351+ $lat;
			$long = -58.4234919 + $long;
			DB::table('clientes')->insert(array(
				'apenom' => $faker->name,
				'direccion' => $faker->address,
				'latitud'	=> $lat,
				'longitud'	=> $long,
				'estado'	=> ClientsStatesDefinition::STATE_NORMAL,
				'telefono' =>  $faker->phoneNumber,
				'observaciones' => $faker->paragraph(),
				'id_vendedor' => rand(1,2),
				'dia_visita_defecto' => rand(1,7),
				'cod_cliente'	=> substr(md5(uniqid(rand(), true)),0,6),
				'razon_social' => $faker->name,
			));
		}
	}

}
<?php


class UpdateClientsAndProductsTableSeeder extends Seeder {

	public function run()
	{
		$this->seedProducts();
		$this->seedClients();
	}

	public function seedClients()
	{
		$clients = Client::all();
		foreach ($clients as $index => $client) {
			$lat = rand(0,10000) / 1000000;
			$long = rand(0,10000) / 1000000;
			$client->latitud = -34.6031351+ $lat;
			$client->longitud = -58.4234919 + $long;
			$client->estado = ClientsStatesDefinition::STATE_NORMAL;
			$client->save();
		}
	}

	public function seedProducts()
	{
		$descripcion = array('Televisión led smart HD',
			'Television led 4K HD con smart');
		
		$this->saveProducts('Tele', $descripcion);

		$descripcion = array('Remera taller L de algodón',
			'Camiseta talle L de hilo');
		
		$this->saveProducts('Reme', $descripcion);

		$descripcion = array('Pantalón talle M vaquero',
			'Pantalón de jean talle L');
		
		$this->saveProducts('Pantal', $descripcion);

		
		$descripcion = array('Mesa de madera tamano 1.60x1.80');
		$this->saveProducts('Mesa', $descripcion);


		
		$descripcion = array('Silla de roble');
		$this->saveProducts('Silla', $descripcion);

		
		$descripcion = array('Amplificador para guitarras eléctricas 4000 wt');
		$this->saveProducts('Ampli', $descripcion);
	}

	private function saveProducts($nameLike,$desripcion)
	{
		$products = Product::where('nombre','like', "%".$nameLike.'%')->get();
		foreach ($products as $index => $product) {
			$product->descripcion = $desripcion[array_rand($desripcion)];
			$product->save();
		}
	}
}
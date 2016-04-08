<?php


class CreateTestUsersTableSeeder extends Seeder {

	public function run()
	{
		$users = array(
			array('email' => 'ezequielmreyes@gmail.com', 'nombre_usuario' => 'Ezequiel', 'password' => '12345'),
			array('email' => 'federicomrossi@gmail.com', 'nombre_usuario' => 'Federico', 'password' => '12345'),
			array('email' => 'pabloqac87@gmail.com', 'nombre_usuario' => 'Pablo', 'password' => '12345'),
			array('email' => 'sabrinacampa@gmail.com', 'nombre_usuario' => 'Sabrina', 'password' => '12345'),
		);

		foreach ($users as $userData) {
			User::create($userData);
		}
	}

}
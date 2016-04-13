<?php


class CreateTestUsersTableSeeder extends Seeder {

	public function run()
	{
		$users = array(
			array('email' => 'ezequielmreyes@gmail.com', 'nombre_usuario' => 'Ezequiel', 'password' => '$2y$10$TZDpi23WuURP7dhsvXde6eyJ.bvgd6ZVwa4Up.JKbLdbOcYswCt2e'),
			array('email' => 'federicomrossi@gmail.com', 'nombre_usuario' => 'Federico', 'password' => '$2y$10$TZDpi23WuURP7dhsvXde6eyJ.bvgd6ZVwa4Up.JKbLdbOcYswCt2e'),
			array('email' => 'pabloqac87@gmail.com', 'nombre_usuario' => 'Pablo', 'password' => '$2y$10$TZDpi23WuURP7dhsvXde6eyJ.bvgd6ZVwa4Up.JKbLdbOcYswCt2e'),
			array('email' => 'sabrinacampa@gmail.com', 'nombre_usuario' => 'Sabrina', 'password' => '$2y$10$TZDpi23WuURP7dhsvXde6eyJ.bvgd6ZVwa4Up.JKbLdbOcYswCt2e'),
			array('email' => 'mdegiov@gmail.com', 'nombre_usuario' => 'Marcio', 'password' => '$2y$10$TZDpi23WuURP7dhsvXde6eyJ.bvgd6ZVwa4Up.JKbLdbOcYswCt2e'),
		);

		foreach ($users as $userData) {
			User::create($userData);
		}
	}

}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDescuentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('descuentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('fecha_inicio')->nullable();
			$table->date('fecha_fin')->nullable();
			$table->string('sin_limites')->nullable();
			$table->string('descripcion')->nullable();
			$table->integer('cant_bultos_min');
			$table->integer('cant_bultos_max');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('descuentos');
	}

}

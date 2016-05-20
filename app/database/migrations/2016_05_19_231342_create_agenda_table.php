<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgendaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agenda', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_cliente');
			$table->date('fecha_visita_programada')->nullable();
			$table->date('fecha_visita_concretada')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('agenda');
	}

}

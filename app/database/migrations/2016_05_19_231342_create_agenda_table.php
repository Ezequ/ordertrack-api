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
			$table->increments('id_agenda');
			$table->integer('id_cliente');
			$table->date('fecha_visita_programada')->nullable();
			$table->date('fecha_visita_concretada')->nullable();
			$table->string('comentario');
			$table->boolean('pedido_hecho');
			$table->integer('id_orden');
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

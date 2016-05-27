<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSellerToAgendaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('agenda', function(Blueprint $table)
		{
			$table->integer('id_vendedor');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('agenda', function(Blueprint $table)
		{
			$table->dropColumn('id_vendedor');
		});
	}

}

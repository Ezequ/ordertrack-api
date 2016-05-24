<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrderDataToOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ordenes', function(Blueprint $table)
		{
			$table->longText('orden_confirmada');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ordenes', function(Blueprint $table)
		{
			$table->dropColumn('orden_confirmada');
		});
	}

}

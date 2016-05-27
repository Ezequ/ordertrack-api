<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDiscountsFieldsToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('productos', function(Blueprint $table)
		{
			$table->integer('descuento_1')->nulleable();
			$table->integer('descuento_1_min')->nulleable();
			$table->integer('descuento_2')->nulleable();
			$table->integer('descuento_2_min')->nulleable();
			$table->integer('descuento_3')->nulleable();
			$table->integer('descuento_3_min')->nulleable();
			$table->integer('descuento_4')->nulleable();
			$table->integer('descuento_4_min')->nulleable();
			$table->integer('descuento_5')->nulleable();
			$table->integer('descuento_5_min')->nulleable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('productos', function(Blueprint $table)
		{
			$table->dropColumn('descuento_1');
			$table->dropColumn('descuento_1_min');
			$table->dropColumn('descuento_2');
			$table->dropColumn('descuento_2_min');
			$table->dropColumn('descuento_3');
			$table->dropColumn('descuento_3_min');
			$table->dropColumn('descuento_4');
			$table->dropColumn('descuento_4_min');
			$table->dropColumn('descuento_5');
			$table->dropColumn('descuento_5_min');
		});
	}

}

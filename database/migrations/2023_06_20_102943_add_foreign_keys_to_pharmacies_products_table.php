<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPharmaciesProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pharmacies_products', function(Blueprint $table)
		{
			$table->foreign('pharmacy_id', 'pharmacies_products_ibfk_1')->references('pharmacy_id')->on('pharmacies')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('product_id', 'pharmacies_products_ibfk_2')->references('product_id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pharmacies_products', function(Blueprint $table)
		{
			$table->dropForeign('pharmacies_products_ibfk_1');
			$table->dropForeign('pharmacies_products_ibfk_2');
		});
	}

}

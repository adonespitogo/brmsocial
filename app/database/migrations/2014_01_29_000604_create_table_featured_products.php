<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableFeaturedProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('featured_products', function($table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->dateTime('featured_start_date');
			$table->dateTime('featured_end_date');
			$table->softDeletes();
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
		Schema::drop('featured_products');
	}

}
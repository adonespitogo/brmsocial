<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('category_id');
			$table->string('product_name');
			$table->string('tagline');
			$table->decimal('regular_price', 10, 2);
			$table->decimal('discounted_price', 10, 2);
			$table->dateTime('sale_start_date');
			$table->dateTime('sale_end_date');
			$table->string('product_image');
			$table->text('overview');
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
		Schema::drop('products');
	}

}
<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('product_id');
			$table->string('product_name');
			$table->decimal('price', 10, 2);
			$table->decimal('amount_commission', 10, 2);
			$table->integer('percentage_commission');
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
		Schema::drop('orders');
	}

}
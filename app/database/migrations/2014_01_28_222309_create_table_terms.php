<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableTerms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terms', function($table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->string('term');
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
		Schema::drop('terms');
	}

}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_transactions', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->boolean('is_credit');
			$table->string('transaction_id');
			$table->string('remarks');
			$table->string('type');
			$table->decimal('amount', 10, 2);
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
		Schema::drop('user_transactions');
	}

}

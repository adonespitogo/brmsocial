<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table){
			$table->string('type');
			$table->dropColumn('is_admin');
			$table->dropColumn('is_vendor');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table){
			$table->boolean('is_admin');
			$table->boolean('is_vendor');
			$table->dropColumn('type');
		});
	}

}

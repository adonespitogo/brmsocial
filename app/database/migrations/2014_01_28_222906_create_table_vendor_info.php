<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableVendorInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendor_info', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('company_name');
			$table->string('website_url');
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
		Schema::drop('vendor_info');
	}

}
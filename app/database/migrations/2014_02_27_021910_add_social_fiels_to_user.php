<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialFielsToUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table){
			$table->string('facebook_url')->nullable();
			$table->string('twitter_url')->nullable();
			$table->string('googleplus_url')->nullable();
			$table->string('linkedin_url')->nullable();
			$table->string('dribble_url')->nullable();
			$table->string('website_url')->nullable();
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
			$table->dropColumn('facebook_url');
			$table->dropColumn('twitter_url');
			$table->dropColumn('googleplus_url');
			$table->dropColumn('linkedin_url');
			$table->dropColumn('dribble_url');
			$table->dropColumn('website_url');
		});
	}

}

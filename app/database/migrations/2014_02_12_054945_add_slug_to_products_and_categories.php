<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToProductsAndCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function($table){
			$table->string('slug')->after('product_name');
		});
		Schema::table('categories', function($table){
			$table->string('slug')->after('category');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function($table){
			$table->dropColumn('slug');
		});
		Schema::table('categories', function($table){
			$table->dropColumn('slug');
		});
	}

}

<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('VendorsTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('CategoriesTableSeeder');
	}

}
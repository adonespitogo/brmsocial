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

		$this->call('UsersTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('FeaturedProductSeeder');
		$this->call('InterestsSeeder');
		$this->call('UserInterestSeeder');
	}

}
<?php

class CategoriesTableSeeder extends Seeder{
	public function run()
	{
		DB::table('categories')->insert(array(
			array(
				'category' => 'Sample Category 1',
				'created_at' => date('Y:m:d H:i:s')
			)
		));
	}
}
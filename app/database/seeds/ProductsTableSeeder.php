<?php

class ProductsTableSeeder extends Seeder{
	public function run()
	{
		DB::table('products')->insert(array(
			array(
				'user_id' => 1,
				'category_id' => 1,
				'product_name' => 'Sample Product 1',
				'tagline' => 'Sample Tagline',
				'regular_price' => '123',
				'discounted_price' => '12',
				'sale_start_date' => date('Y:m:d H:i:s'),
				'sale_end_date' => date('Y:m:d H:i:s'),
				'product_image' => '',
				'overview' => 'This is an overview',
				'created_at' => date('Y:m:d H:i:s')
			)
		));
	}
}
<?php

class ProductsTableSeeder extends Seeder{
	public function run()
	{
		$now = Carbon\Carbon::now();
		$end = $now->copy()->addDays(5);
		
		DB::table('products')->insert(array(
			array(
				'user_id' => 1,
				'category_id' => 1,
				'product_name' => 'Sample Product 1',
				'slug' => 'sample-product-1',
				'tagline' => 'Sample Tagline',
				'regular_price' => '123',
				'discounted_price' => '12',
				'sale_start_date' => $now,
				'sale_end_date' => $end,
				'product_image' => '',
				'overview' => 'This is an overview',
				'created_at' => date('Y:m:d H:i:s')
			),
			array(
				'user_id' => 1,
				'category_id' => 1,
				'product_name' => 'Sample Product 2',
				'slug' => 'sample-product-2',
				'tagline' => 'Sample Tagline 2',
				'regular_price' => '123',
				'discounted_price' => '12',
				'sale_start_date' => $now,
				'sale_end_date' => $end,
				'product_image' => '',
				'overview' => 'This is an overview',
				'created_at' => date('Y:m:d H:i:s')
			)
		));
	}
}
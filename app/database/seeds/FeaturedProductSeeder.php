<?php

class FeaturedProductSeeder extends Seeder{
	public function run()
	{
		$now = Carbon\Carbon::now();
		$start = $now->copy()->subDays(5);
		$end = $now->copy()->addDays(5);
		DB::table('featured_products')->insert(array(
			array(
				'product_id' => 1,
				'featured_start_date' => $start,
				'featured_end_date' => $end
			),
		));
	}
}
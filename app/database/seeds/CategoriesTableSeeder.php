<?php

class CategoriesTableSeeder extends Seeder{
	public function run()
	{
		DB::table('categories')->insert(array(
			array(
				'category' => 'Social Media',
				'slug' => 'social-media',
				'created_at' => date('Y:m:d H:i:s')
			),
			array(
				'category' => 'Design',
				'slug' => 'design',
				'created_at' => date('Y:m:d H:i:s')
			),
			array(
				'category' => 'Email',
				'slug' => 'email',
				'created_at' => date('Y:m:d H:i:s')
			),
			array(
				'category' => 'Music',
				'slug' => 'music',
				'created_at' => date('Y:m:d H:i:s')
			),
			array(
				'category' => 'Video',
				'slug' => 'video',
				'created_at' => date('Y:m:d H:i:s')
			),
			array(
				'category' => 'Entrepreneur',
				'slug' => 'entrepreneur',
				'created_at' => date('Y:m:d H:i:s')
			),
			array(
				'category' => 'Paid Advertising',
				'slug' => 'paid-advertising',
				'created_at' => date('Y:m:d H:i:s')
			)
		));
	}
}
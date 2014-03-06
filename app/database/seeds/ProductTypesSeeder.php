<?php

class ProductTypesSeeder extends Seeder{
	public function run()
	{
		Eloquent::unguard();
		
		ProductType::insert(
			array(
				
				array(
					'type'=>'Video Tutorials', 
					'description' => '',
					'has_file' => false
				),
				array(
					'type'=>'App',
					'description' => '',
					'has_file'=>true, 
				), 
				array(
					'type'=>'Ebook',
					'description' => '',
					'has_file'=>true, 
				),
			)
		);
	}
}
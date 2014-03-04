<?php

class ProductTypesSeeder extends Seeder{
	public function run()
	{
		ProductType::insert(array(
				array('type'=>'Video Tutorials'),
				array('type'=>'App','has_file'=>true), 
				array('type'=>'Ebook','has_file'=>true),
			));
	}
}
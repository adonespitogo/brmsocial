<?php

class ProductTypesSeeder extends Seeder{
	public function run()
	{
		ProductType::insert(array(
				array('type'=>'Video Tutorials'),
				array('type'=>'App'), 
				array('type'=>'Ebook'),
			));
	}
}
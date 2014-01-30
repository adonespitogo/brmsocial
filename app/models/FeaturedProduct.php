<?php

use LaravelBook\Ardent\Ardent;

class FeaturedProduct extends Ardent{

	protected $table = 'featured_products';
	protected $softDelete = true;

	public static $relationsData = array(
		'product' => array(self::BELONGS_TO, 'Product')
	);

	// start custom functions
	public static function getFeaturedProducts()
	{
		$datenow = date("Y-m-d H:i:s");
		$products = self::where('featured_start_date', '<=', $datenow)
						->where('featured_end_date', '>=', $datenow)
						->with('product')
						->get();

		return $products;
	}

}

?>
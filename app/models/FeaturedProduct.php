<?php

//use LaravelBook\Ardent\Ardent;

class FeaturedProduct extends BaseModel{

	protected $table = 'featured_products';
	protected $softDelete = true;

	public static $relationsData = array(
		'product' => array(self::BELONGS_TO, 'Product')
	);

	protected $fillable = array(
		 'featured_start_date',
		'featured_end_date',
		'product_id',
	);

	protected $isodates = array('featured_start_date', 'featured_end_date', 'created_at'); 

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

	public static function getFeaturedProduct() {
		$datenow = date("Y-m-d H:i:s");
		$products = self::where('featured_start_date', '<=', $datenow)
						->where('featured_end_date', '>=', $datenow)
						->orderBy('created_at', 'DESC')
						->limit(1)
						->with('product')
						->get();

		return $products;
	}

	public static function getFeaturedProductToday()
	{
		$now = Carbon\Carbon::now()->endOfDay();
		$featured = self::where('featured_start_date', '<=', $now)
						->where('featured_end_date', '>=', $now )
						->orderBy('created_at', 'DESC')
						->first();
			
		if(is_object($featured))			
			$featured->load('product');
		return $featured;
	}

}

?>
<?php

// use LaravelBook\Ardent\Ardent;

class Product extends BaseModel{ 
		
	protected $table = 'products';
	protected $softDelete = true;

	protected $fillable = array(
		'category_id',
		'product_name',
		'tagline',
		'regular_price',
		'discounted_price',
		'overview',
		'sale_start_date',
		'sale_end_date',
	);

	protected $isodates = array('sale_start_date', 'sale_end_date', 'created_at'); //js Date fields to format to datetime on save

	public static $relationsData = array(
		'category' => array(self::BELONGS_TO, 'Category'),
		'user' => array(self::BELONGS_TO, 'User'),
		'orders' => array(self::HAS_MANY, 'Order'),
		'terms' => array(self::HAS_MANY, 'Term'),
		'traffic' => array(self::HAS_MANY, 'Traffic')
	);
	//start overrides
	public function __construct()
	{	 
		parent::__construct();
		$this->sale_start_date = date('Y:m:d H:i:s');
		$this->sale_end_date = date('Y:m:d H:i:s');
		$this->product_image = 'default.png';
		$this->category_id = Category::first()->id;
	}
	
	public function toArray()
	{
		$this->load('category');
		$this->load('terms');

		$this->traffic_today = $this->traffic()->whereRaw("created_at >= CONCAT(CURDATE(), ' 00:00:00') AND created_at <=  CONCAT(CURDATE(), ' 23:59:59')")->groupBy('ip')->count();
		$this->traffic_today = is_null($this->traffic_today) ? 0 : $this->traffic_today;

		return parent::toArray();
	}

	// start custom functions

	public function getProductTraffic() {

		$id = $this->id;


		$d = array();
		for($i = 0; $i < 15; $i++) {
    		$d[] = date("d", strtotime('-'. $i .' days'));
		}


		$traffic = DB::select(DB::raw("SELECT date_format(created_at, '%d') AS elapsed, CASE WHEN COUNT(id) > 0 THEN COUNT(id) ELSE 0 END AS value
											FROM product_traffic 
												WHERE product_id=".$id."
													GROUP BY date_format(created_at, '%d')
														LIMIT 30"));

		return $traffic;
	}

	public function pictures(){
		return $this->hasMany('ProductPicture');
	}
}

?>
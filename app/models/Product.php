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
		$this->traffic_today_count = $this->getTrafficTodayCount();

		return parent::toArray();
	}

	// start custom functions

	public function loadProductTraffic()
	{
		$this->load(array('traffic' => function($query){
			$days = 30;  //days of traffic to load
			$today = Carbon\Carbon::now();
			$last_num_days_date = $today->subDays($days);
			$query->where('created_at', '>=', $last_num_days_date);
		}));

	}

	public function pictures(){
		return $this->hasMany('ProductPicture');
	}

	public function getTrafficTodayCount()
	{
		$today = Carbon\Carbon::now()->startOfDay();
		$count = $this->traffic()->where('created_at', '>=', $today)->count();
		if(is_null($count)){
			return 0;
		}
		return $count;
	}

}

?>
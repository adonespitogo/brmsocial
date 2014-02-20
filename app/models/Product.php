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
		'user_id',
	);

	protected $isodates = array('sale_start_date', 'sale_end_date', 'created_at'); //js Date fields to format to datetime on save
	protected $hasSlug = array(
		'slugColumn' => 'slug',
		'slugFromColumn' => 'product_name'
	);

	protected $appends = array('is_featured');
	public static $relationsData = array(
		'category' => array(self::BELONGS_TO, 'Category'),
		'user' => array(self::BELONGS_TO, 'User'),
		'orders' => array(self::HAS_MANY, 'Order'),
		'terms' => array(self::HAS_MANY, 'Term'),
		'traffic' => array(self::HAS_MANY, 'Traffic'),
		'pictures' => array(self::HAS_MANY, 'ProductPicture'),
		'files' => array(self::HAS_MANY, 'ProductFile'),
		'featured'=>array(self::HAS_ONE,'FeaturedProduct'),
	);

	//start overrides
	public function __construct()
	{	 
		parent::__construct();
		$this->sale_start_date = date('Y:m:d H:i:s');
		$this->sale_end_date = date('Y:m:d H:i:s');
		$this->product_image = false; 
		$this->max_download = 1;
		//$this->category_id = Category::first()->id;
	}
	
	public function toArray()
	{
		$this->load('category');
		$this->load('terms');
		$this->load('featured');
		$this->load('user'); 
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

	public function getTrafficTodayCount()
	{
		$today = Carbon\Carbon::now()->startOfDay();
		$count = $this->traffic()->where('created_at', '>=', $today)->count();
		if(is_null($count)){
			return 0;
		}
		return $count;
	}

	public function getDiscountPercentage()
	{
		$rp = $this->regular_price;
		$dp = $this->discounted_price;
		$return = ($rp - $dp) / $rp * 100;
		$return = number_format($return, 0);
		return $return;
	}

	public function getLeftSaleDays()
	{
		$end_date = Carbon\Carbon::parse($this->sale_end_date);
		$now = Carbon\Carbon::now();
		return $now->diffInDays($end_date);
	}

	public function getEndDatePercentage()
	{
		$sale_start_date = Carbon\Carbon::parse($this->sale_start_date);
		$sale_end_date = Carbon\Carbon::parse($this->sale_end_date);

		$lengthMins = $sale_start_date->diffInMinutes($sale_end_date);
		$min_now = Carbon\Carbon::now();
		$leftMins = $min_now->diffInMinutes($sale_end_date);

		$return = number_format($leftMins/$lengthMins * 100, 2);
		if($return > 100) return 100;
		return $return;
	}

	public static function getUpcomingSales()
	{
		return self::where('sale_start_date', '>', Carbon\Carbon::now())->get();
	}
	
	public static function getByCategory($category)
	{
		$now = Carbon\Carbon::now();
		return self::where('category_id', $category->id)
					->where('sale_start_date', '<=', $now)
					->where('sale_end_date', '>=', $now)
					->get();
	}
	
	public static function getMostPopular()
	{
		return self::orderBy('created_at')->limit(3)->get();
	}
	public function getIsFeaturedAttribute(){
		if(isset($this->featured->id))
			return true;
		else
			return false;
	}

}

?>
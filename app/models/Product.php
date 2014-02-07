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

	public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called
  	public $autoPurgeRedundantAttributes = true;

	protected $jsdatefields = array('sale_start_date', 'sale_end_date'); //js Date fields to format to datetime on save

	public static $relationsData = array(
		'category' => array(self::BELONGS_TO, 'Category'),
		'user' => array(self::BELONGS_TO, 'User'),
		'orders' => array(self::HAS_MANY, 'Order'),
		'terms' => array(self::HAS_MANY, 'Term'),
	);
	//start overrides
	public function __construct()
	{
		parent::__construct();
		$this->sale_start_date = date('Y:m:d H:i:s');
		$this->sale_end_date = date('Y:m:d H:i:s');
	}
	
	public function toArray()
	{
		$this->load('category');
		$this->load('terms');
		return parent::toArray();
	}
	
	// start custom functions
}

?>
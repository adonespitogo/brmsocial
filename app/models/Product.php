<?php

use LaravelBook\Ardent\Ardent;

class Product extends Ardent{

	protected $table = 'products';
	protected $softDelete = true;

	public static $relationsData = array(
		'category' => array(self::BELONGS_TO, 'Category'),
		'user' => array(self::BELONGS_TO, 'User'),
		'orders' => array(self::HAS_MANY, 'Order'),
		'terms' => array(self::HAS_MANY, 'Term'),
		'traffic' => array(self::HAS_MANY, 'Traffic')
	);
	//start overrides
	public function toArray()
	{
		$this->load('category');
		$this->load('terms');

		$this->traffic_today = $this->traffic()->whereRaw("created_at >= CONCAT(CURDATE(), ' 00:00:00') AND created_at <=  CONCAT(CURDATE(), ' 23:59:59')")->groupBy('ip')->count();
		$this->traffic_today = is_null($this->traffic_today) ? 0 : $this->traffic_today;

		return parent::toArray();
	}

	// start custom functions

	public function getProductTraffic($id) {

		$traffic = DB::select(DB::raw("SELECT date_format(created_at, '%d') AS elapsed, COUNT(id) AS value
											FROM product_traffic 
												WHERE product_id=".$id."
													GROUP BY date_format(created_at, '%d')
														LIMIT 30"));

		return $traffic;
	}
}

?>
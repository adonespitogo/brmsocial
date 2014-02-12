<?php

// use LaravelBook\Ardent\Ardent;

class Order extends BaseModel{

	protected $table = 'orders';
	protected $softDelete = true;

	protected $isodates = array(
		'created_at',
	);

	public static $relationsData = array(
		'user' => array(self::BELONGS_TO, 'User'),
		'product' => array(self::BELONGS_TO, 'Product'),
	);

}

?>
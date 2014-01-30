<?php

use LaravelBook\Ardent\Ardent;

class Order extends Ardent{

	protected $table = 'orders';
	protected $softDelete = true;

	public static $relationsData = array(
		'user' => array(self::BELONGS_TO, 'User'),
		'product' => array(self::BELONGS_TO, 'Product'),
	);

}

?>
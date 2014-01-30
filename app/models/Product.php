<?php

use LaravelBook\Ardent\Ardent;

class Product extends Ardent{

	protected $table = 'products';
	protected $softDelete = true;

	public static $relationsData = array(
		'category' => array(self::BELONGS_TO, 'Category'),
		'user' => array(self::BELONGS_TO, 'User'),
		'orders' => array(self::HAS_MANY, 'Order'),
		'Terms' => array(self::HAS_MANY, 'Term'),
	);

	// start custom functions

}

?>
<?php

use LaravelBook\Ardent\Ardent;

class Category extends Ardent{

	protected $table = 'categories';
	protected $softDelete = true;

	public static $relationsData = array(
		'products' => array(self::HAS_MANY, 'Product'),
	);
}

?>
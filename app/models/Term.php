<?php

use LaravelBook\Ardent\Ardent;

class Term extends Ardent{

	protected $table = 'terms';
	protected $softDelete = true;

	public static $relatonsData = array(
		'product' => array(self::BELONGS_TO, 'Product'),
	);

}

?>
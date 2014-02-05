<?php

class Product extends BaseModel{

	protected $table = 'products';
	protected $softDelete = true;

	protected $jsdatefields = array('sale_start_date');

	public static $relationsData = array(
		'category' => array(self::BELONGS_TO, 'Category'),
		'user' => array(self::BELONGS_TO, 'User'),
		'orders' => array(self::HAS_MANY, 'Order'),
		'terms' => array(self::HAS_MANY, 'Term'),
	);
	//start overrides
	public function toArray()
	{
		$this->load('category');
		$this->load('terms');
		return parent::toArray();
	}
	// start custom functions

}

?>
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
		'product' => array(self::BELONGS_TO, 'Product')
	);

	public function toArray() {

		$this->load('product');

		return parent::toArray();

	}

	public function getPicture()
	{
		$pic = URL::to($this->product->pictures[0]->picture->url());
		return $pic;
	}

	public function loadPicture()
	{
		$this->picture = $this->getPicture();
	}

}

?>
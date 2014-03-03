<?php

// use LaravelBook\Ardent\Ardent;

class Order extends BaseModel{

	protected $table = 'orders';
	protected $softDelete = true;

	protected $isodates = array(
		'created_at',
	);

	public static $relationsData = array(
		'vendor' => array(self::BELONGS_TO, 'User', 'foreignKey' =>'vendor_id'),
		'buyer' => array(self::BELONGS_TO, 'User', 'foreignKey' => 'user_id'),
		'product' => array(self::BELONGS_TO, 'Product'),
		'commission' => array(self::HAS_ONE, 'Commission')
	);

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
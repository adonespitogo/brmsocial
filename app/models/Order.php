<?php

// use LaravelBook\Ardent\Ardent;

class Order extends BaseModel{
	
	public function __construct()
	{
		parent::__construct();
		$this->download_count = 0;
		$this->max_download = 1;
	}

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

	public function loadDownloadUrl(){
		$this->download_url = URL::to('download/'.$this->id.'/'.$this->product->id.'/0');
	}
	
	public function afterCreate()
	{
		//share commission to vendor
		$c = new Commission();
		$c->user_id = $this->vendor_id;
		$c->order_id = $this->id;
		$c->product_id = $this->product_id;
		$c->commission = $this->amount_commission;
		$c->save();
		
	}
}

?>
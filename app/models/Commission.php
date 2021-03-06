<?php

	class Commission extends BaseModel {
		
		public function __construct()
		{
			parent::__construct();
			$this->is_paid = 0;
		}

		protected $table = 'commissions';

		protected $isodates = array('paid_at');

		public static $relationsData = array(
			'vendor' => array(self::BELONGS_TO, 'User', 'foreignKey' => 'user_id'),
			'order' => array(self::BELONGS_TO, 'Order', 'foreignKey' => 'order_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'foreignKey' => 'product_id'),
		);

	}

?>
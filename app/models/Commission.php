<?php

	class Commission extends BaseModel {

		protected $table = 'commissions';

		public static $relationsData = array(
			'vendor' => array(self::BELONGS_TO, 'User', 'foreignKey' => 'user_id'),
			'order' => array(self::BELONGS_TO, 'Order', 'foreignKey' => 'order_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'foreignKey' => 'product_id'),
		);

		public function toArray()
		{
			$this->load('order');
			$this->load('product');
			return parent::toArray();
		}

	}

?>
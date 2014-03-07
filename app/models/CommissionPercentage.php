<?php

	class CommissionPercentage extends BaseModel {

		protected $table = 'commission_percentage';
 
		public static $relationsData = array( 
			'product' => array(self::BELONGS_TO, 'Product', 'foreignKey' => 'product_id'),
		);

	}

?>


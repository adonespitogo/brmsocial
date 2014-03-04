<?php

	class Cart extends Eloquent {

		protected $table = 'cart';

		protected $appends = array('product_picture','discount_percentage');
		public function product() {
			return $this->belongsTo('Product');
		}

		public function getProductPictureAttribute(){
			return $this->product->pictures[0]->picture->url('medium');
		}

		public function getDiscountPercentageAttribute(){
			return $this->product->getDiscountPercentage();
		} 
 	}

?>
<?php

	class Cart extends Eloquent {

		protected $table = 'cart';

		protected $appends = array('product_picture','discount_percentage');
		public function product() {
			return $this->belongsTo('Product');
		}
		public function user(){
			return $this->belongsTo('User');
		}
		public function getProductPictureAttribute(){
			return $this->product->pictures[0]->picture->url('medium');
		}

		public function getDiscountPercentageAttribute(){
			return $this->product->getDiscountPercentage();
		} 

		public static function getCartSummary(){
			$cartItems = parent::where('cart_session_id', $_COOKIE['cart_session_id'])->with('product')->get();
			$totalPrice = 0;
			$numItem = 0;
			foreach ($cartItems as $key => $item) {
				$numItem +=1;
				$totalPrice +=$item->product->discounted_price;
			}
			return array('numItem'=>$numItem, 'totalPrice'=>$totalPrice);
		}
 	}

?>
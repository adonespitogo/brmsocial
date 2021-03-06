<?php

	class CartController extends BaseController {

		protected $paymentTypes = array('paypal','credit-card');


		public function getIndex() {

			return View::make('public.cart');

		}

		public function getItems(){
			$items = Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->with('product')->get();
 			return $items;
		}
		public function postAdd() {
			
			$c = new Cart();

			$c->user_id 			= isset(Auth::user()->id) ? Auth::user()->id : 0;
			$c->cart_session_id		= $_COOKIE['cart_session_id'];
			$c->product_id 			= Input::get('product_id');
			$c->buyer_email 		= Auth::user() ? Auth::user()->email : '';
			$c->save();

		}

		public function deleteIndex($id = '') {
 
			$c = Cart::find($id);
			$c->delete();
		}

		public function postUpdateBuyerEmail() {

			$email = Input::get('email');
			$user = User::where('email', $email)->first();
			$user_id = $user ? $user->id : 0;
			Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->update(array('buyer_email' => $email,'user_id'=>$user_id));

		} 
	}

?>
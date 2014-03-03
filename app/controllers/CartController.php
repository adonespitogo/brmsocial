<?php

	class CartController extends BaseController {

		public function getIndex() {

			$cart = Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->get();

			return View::make('public.cart', array(
												'cart_items' => $cart
											)
							);

		}

		public function postAdd() {
			
			$c = new Cart();

			$c->user_id 			= isset(Auth::user()->id) ? Auth::user()->id : 0;
			$c->cart_session_id		= $_COOKIE['cart_session_id'];
			$c->product_id 			= Input::get('product_id');
			$c->save();

		}

		public function postDelete() {

			$id = Input::get('id');

			$c = Cart::find($id);
			$c->delete();
		}

		public function postUpdateBuyerEmail() {

			$email = Input::get('email');

			Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->update(array('buyer_email' => $email));

		}
 
	}

?>
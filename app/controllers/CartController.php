<?php

	class CartController extends BaseController {

		public function getIndex() {

			$cart = Cart::where('cart_session_id', $_COOKIE['cart_session_id']);

			return View::make('public.cart', [
					'cart_items' => $cart
				]);

		}

		public function postAdd() {
			echo '...';
		}

	}

?>
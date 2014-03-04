<?php

	class PaymentController extends BaseController {

		protected $paymentTypes = array('paypal','credit-card');
	 

		public function getGoPay($type=''){
			if(!in_array($type, $this->paymentTypes))
				return View::make('errors.404');

			$cart = Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->get();

			$checkItems = array();
			foreach ($cart as $key => $item) {
				$itemVal = array(
								'quantity'=>1,
								'name'=>$item->product->product_name, 
								'description'=>$item->product->product_name, 
								'amount'=>$item->product->discounted_price);
				$checkItems[] = $itemVal;
			}   
			return Redirect::to(PayPalHelper::getExpressURL($checkItems));
			
		}
		public function getBuyFromPaypalOrdinary(){
			if(!Input::has('token'))
				return Redirect::to('');

			$token = Input::get('token'); 

			$data = PayPalHelper::confirmOrders($token);
 			$cartItems = Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->with(array('product'))->get();

 			$orderExists = Order::where('txn_id', $data->paypal_info->PAYMENTINFO_0_TRANSACTIONID)->get();

 			if(is_object($orderExists)&&count($orderExists)>0)
 				Session::flash('warning','Transaction already exist.');
 			else{
				$user_id = '';
				if(Auth::user()) {
					$user_id = Auth::user()->id;
				}					
				else
				{	$emailFromOrder = $cartItems[0]->buyer_email;
					$user = User::where('email',$emailFromOrder)->first();
					if(!is_object($user)|| count($user)<=0)
					{	
						$tmp = explode("@", $emailFromOrder);
						$name = $tmp[0]; 

						$user = new User();
						$user->firstname = $name; 
						$user->email = $emailFromOrder;
						$user->type = 'customer'; 
						$this->setPassword(BRMHelper::genRandomPassword());
						$user->save();

						print_r($user->validationErros());
						die();
					}
					
					$user_id = $user->id;
				}

				foreach ($cartItems as $key => $item) {
						$order = new Order();
 						$order->user_id = $user->id;
 						$order->product_id = $item->product_id;
 						$order->vendor_id = $item->product->user_id; 	
 						$order->product_name = $item->product->product_name;
 						$order->price = $item->product->discounted_price;
 						$order->txn_id = $data->paypal_info->PAYMENTINFO_0_TRANSACTIONID;
 						$order->save();
					}
					
				MailHelper::afterPurchaseMessage($cartItems);
				Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->with(array('product'))->delete();
 				
 			} 			

 			echo Session::get('warning');
 			return "Thank you page here";


		}

	}

?>
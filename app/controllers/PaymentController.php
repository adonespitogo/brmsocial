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

			$paypalResp = PayPalHelper::confirmOrders($token);//array('success' => `boolean true||false`, 'payal_info' => `array`)
 
			if($paypalResp['success']){

	 			$cartItems = Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->with(array('product','user'))->get();

	 			$orderExists = Order::where('txn_id', $paypalResp['paypal_info']['PAYMENTINFO_0_TRANSACTIONID'])->get();

	 			$user = null;

	 			if(is_object($orderExists)&&count($orderExists)>0)
	 				Session::flash('warning','Transaction already exist.');

	 			else
	 			{
					$user_id = '';
					if(Auth::user()) 
					{
						$user = Auth::user();
					}					
					else
					{	
						$emailFromOrder = $cartItems[0]->buyer_email;
						$user = User::where('email',$emailFromOrder)->first();
						if(!$user)
						{	
							$tmp = explode("@", $emailFromOrder);
							$name = $tmp[0]; 

							$user = new User();
							$user->firstname = $name; 
							$user->email = $emailFromOrder;
							$user->type = 'customer'; 
							$user->setPassword(BRMHelper::genRandomPassword());
							$user->save();

							if($user->validationErrors)
								Session::flash('error',$user->validationErrors); 

						}
						 
					}

					$orderItems = array();
					foreach ($cartItems as $key => $item) {
						$orderItems[] = array(
								'user_id' =>$user->id,
								'product_id' => $item->product_id,
								'vendor_id' => $item->product->user_id, 	
								'product_name' => $item->product->product_name,
								'price' => $item->product->discounted_price,
								'txn_id' => $paypalResp['paypal_info']['PAYMENTINFO_0_TRANSACTIONID'],
								'created_at'=>date('Y-m-d H:i:s'),
							); 
					}

					Order::insert($orderItems);  
					
					Order::afterCreate($cartItems, $orderItems);

	 			} 
			}	
			else{
				Session::flash('error', /*(String)*/$paypalResp['paypal_info']['L_SEVERITYCODE0'].". ".$paypalResp['paypal_info']['L_LONGMESSAGE0']);
			}		


			//Thank you page here with these errr messages
 			echo Session::get('warning');
 			echo Session::get('error');
 			return "Thank you page here";


		}

	}

?>
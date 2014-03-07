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
								'max_download'=>$item->product->max_download,
							);
						$order = new Order();
						$order->user_id 				= $user->id;
						$order->product_id 				= $item->product_id;
						$order->vendor_id 				= $item->getVendor()->id;
						$order->product_name 			= $item->product->product_name;
						$order->price 					= $item->product->discounted_price;
						$order->txn_id 					= $paypalResp['paypal_info']['PAYMENTINFO_0_TRANSACTIONID'];
						$order->created_at 				= date('Y-m-d H:i:s');
						$order->max_download 			= $item->product->max_download;
						$order->percentage_commission 	= $item->getCommissionPercentage();
						$order->amount_commission 		= ((float)$order->price * (floatval($order->percentage_commission)/100));
						$order->save();
					} 
		
					Cart::where('cart_session_id', $_COOKIE['cart_session_id'])->delete();
					
					MailHelper::afterPurchaseMessage($cartItems, $orderItems);

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
		public function getPurchaseFree($productId=0){ 

			if(!Session::has('free_step_1')||!Session::has('free_step_2') || !in_array($productId, Session::get('free_step_1'))|| !in_array($productId, Session::get('free_step_2')))
				return Response::json(array('status'=>403, 'error'=>'Forbidden'), 403);

			$product = Product::find($productId);

			if(!is_object($product))
				return Response::json(array('status'=>404, 'error'=>'Free Product not found'), 404);
			 
			$order = new Order();
			$order->user_id 				= Auth::user()->id;
			$order->product_id 				= $product->id;
			$order->vendor_id 				= $product->user_id;
			$order->product_name 			= $product->product_name;
			$order->price 					= $product->discounted_price;
			$order->txn_id 					= '(FREE order has no Transaction ID)';
			$order->created_at 				= date('Y-m-d H:i:s');
			$order->max_download 			= $product->max_download;
			$order->percentage_commission 	= 0;
			$order->amount_commission 		= 0;
			$order->save();

			MailHelper::afterPurchaseMessage(array($order), array($order));

			return "thank you page here";
		}

	}

?>
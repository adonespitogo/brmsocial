<?php

	class Cart extends Eloquent {

		public function __construct() {	 

			parent::__construct();
			$this->initCookie();
			
		}

		public function initCookie(){
			
			if(isset($_COOKIE['cart_session_id'])){ 
				if(strlen($_COOKIE['cart_session_id'])>10) return;
			}	
			
			$randomData = sha1($_SERVER['REMOTE_ADDR'].microtime().'cart-cookie');
			return setcookie('cart_session_id', $randomData, time()+60*60*24*31, '/');
		}

	}

?>
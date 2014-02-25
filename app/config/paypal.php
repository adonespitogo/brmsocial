<?php

$ip = Location::getIp();
$local_ips = array('202.78.93.154', '122.3.199.205', '121.96.56.8','121.96.56.9', '127.0.0.1');

if(in_array($ip, $local_ips) || strpos($_SERVER['HTTP_HOST'], "localhost")!==false){
	return array(
		'notifyUrl' => 'http://www.buyrealmarketing.com/testipn.php',
		'returnUrl' => URL::to('payment/buy-from-paypal-ordinary'),
		'cancelUrl' => URL::to('services'),
		'paypalDomain' => 'sandbox.paypal.com',
		'username' => 'arnel.lenteria_api1.gmail.com',
		'email' => 'arnel.lenteria@gmail.com',
		'password' => '1366331800',
		'signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31ARhoNnuwNI6KgI8eDX6ZccmSs3Gs',
	);
}else{
	return array(
		'returnUrl' => URL::to('payment/buy-from-paypal-ordinary'),
		'cancelUrl' => URL::to('feedback'),
		'paypalDomain' => 'paypal.com',
		'username' => 'jonathan_api1.clickinglabs.com',
		'email' => 'payment@springrank.com',
		'password' => 'XQKFFDDKDSMMUW2A',
		'signature' => 'AHhNMpAKZN-Z0qfZUm7-w1XzIb2YAiHcx8kG9J961Dy-hy0H.HbdIkZF',
	);
}
 

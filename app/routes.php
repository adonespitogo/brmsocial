<?php

Route::get('/', function()
{
	return View::make('session.login');
});


// start public routes
Route::controller('session', 'SessionController');


// start protected routes
Route::group(array('before' => 'auth'), function(){

	Route::controller('home', 'HomeController');

	Route::get('users/me', array('uses' => 'UserController@currentUser'));
	Route::put('users/me', array('uses' => 'RegisterController@updateAccount'));
	Route::get('users/all', array('uses'=>'UserController@getAll'));
	Route::resource('users', 'UserController');

	Route::get('products/my-products', array('uses' => 'ProductController@myProducts'));
	Route::get('products/my-active-products', array('uses' => 'ProductController@myActiveProducts'));
	Route::get('products/my-active-products-count', array('uses' => 'ProductController@myActiveProductsCount'));
	Route::get('product/{id}/traffic', array('uses' => 'ProductController@productTraffic'));
	Route::post('products/{id}', 'ProductController@postIndex');
	Route::get('products/{id}', 'ProductController@getIndex');
	Route::controller('products', 'ProductController');
	

	Route::get('orders/myordersoldtodaycount', array('uses' => 'OrderController@myOrdersSoldTodayCount'));
	Route::get('orders/mysalestoday', array('uses' => 'OrderController@mySalesToday'));
	Route::get('orders/my-orders', array('uses' => 'OrderController@myOrdersList'));
	Route::get('sales', array('uses' => 'OrderController@mySalesList'));

	Route::get('commissions/my-receivable-commissions', array('uses' => 'CommissionController@myReceivableCommission'));
	Route::get('commissions/my-received-commissions', array('uses' => 'CommissionController@myReceivedCommission'));
	Route::get('commissions/my-unpaid-commissions', array('uses' => 'CommissionController@unpaidCommissions'));
	Route::get('commissions/my-paid-commissions', array('uses' => 'CommissionController@paidCommissions'));
	
	Route::resource('traffic', 'TrafficController');

	Route::controller('categories', 'CategoryController');
});

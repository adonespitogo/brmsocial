<?php



// start public routes
Route::get('/', array('uses' => 'PublicController@index'));
Route::get('product/{slug}', array('uses' => 'PublicController@product'));
Route::get('category/{slug}', array('uses' => 'CategoryController@productByCategory'));
Route::controller('session', 'SessionController');
Route::controller('register', 'RegisterController');
Event::listen('404', function()
{
    return "fox was here";
});

// start protected routes
Route::group(array('before' => 'auth'), function(){
	Route::get('users/me', array('uses' => 'UserController@currentUser'));
	Route::get('users/count', array('uses' => 'UserController@countUsers'));
	Route::put('users/me', array('uses' => 'RegisterController@updateAccount'));
	Route::post('users/is-unique', array('uses'=>'UserController@isUnique'));
	Route::get('users/all', array('uses'=>'UserController@getAll'));
	Route::get('users/vendor', array('uses'=>'UserController@getUsers'));
	Route::post('users/add-image', array('uses' => 'UserController@addImage'));
	Route::resource('users', 'UserController');
	
	Route::controller('home', 'HomeController');

	Route::get('products/my-products', array('uses' => 'ProductController@myProducts'));
	Route::get('products/count', array('uses' => 'ProductController@countProducts'));
	Route::get('products/my-active-products', array('uses' => 'ProductController@myActiveProducts'));
	Route::get('products/my-active-products-count', array('uses' => 'ProductController@myActiveProductsCount'));
	Route::get('products/featured-product', array('uses' => 'ProductController@featuredProduct'));
	Route::get('product/{id}/traffic', array('uses' => 'ProductController@productTraffic'));
	Route::post('product/add-image', array('uses'=>'ProductController@postAddImage'));
	Route::post('product/add-file', array('uses'=>'ProductController@postAddFile'));
	Route::resource('products', 'ProductController');
	
	Route::get('orders/myordersoldtodaycount', array('uses' => 'OrderController@myOrdersSoldTodayCount'));
	Route::get('orders/count', array('uses' => 'OrderController@countOrders'));
	Route::get('orders/mysalestoday', array('uses' => 'OrderController@mySalesToday'));
	Route::get('orders/my-orders', array('uses' => 'OrderController@myOrdersList'));
	Route::get('orders/all', array('uses' => 'OrderController@allOrders'));
	Route::get('sales', array('uses' => 'OrderController@mySalesList'));

	Route::post('interests/update-user-interest', array('uses' => 'InterestController@updateUserInterest'));
	Route::get('interests/my-interests', array('uses' => 'InterestController@myInterest'));
	Route::resource('interests', 'InterestController');

	Route::get('commissions/my-receivable-commissions', array('uses' => 'CommissionController@myReceivableCommission'));
	Route::get('commissions/my-received-commissions', array('uses' => 'CommissionController@myReceivedCommission'));
	Route::get('commissions/my-paid-commissions', array('uses' => 'CommissionController@paidCommissions'));
	Route::get('commissions/my-unpaid-commissions', array('uses' => 'CommissionController@unpaidCommissions'));

	Route::resource('traffic', 'TrafficController');
	
	Route::resource('user/subscriptions', 'SubscriptionController');


	Route::get('categories/{slug}', array('uses' => 'CategoryController@getProducts'));
	Route::resource('categories', 'CategoryController');

	Route::get('download/{orderId}/{productId}/{productFileIndex}', array('uses'=>'ProductController@getDownload'));

	Route::get('categories/count', array('uses'=>'CategoryController@countCategories'));
	Route::resource('categories', 'CategoryController');

	Route::get('download/{orderId}/{productId}/{productFileIndex}', array('uses'=>'ProductController@getDownload'));
	
	Route::controller('referrals', 'ReferralController');
}); 

Route::get('fox', function(){
	$filepath = app_path().'/storage/product/files/000/000/016/paid_orders-2-13-2014.sql';
	//$file = readfile($filepath);

	return Response::download($filepath);
});

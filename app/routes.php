<?php

Route::get('/', function()
{
	return View::make('session.login');
});


// start public routes
Route::controller('session', 'SessionController');


// start protected routes
Route::group(array('before' => 'auth'), function(){
	Route::get('users/me', array('uses' => 'UserController@currentUser'));
	Route::controller('home', 'HomeController');
	Route::get('products/my-products', array('uses' => 'ProductController@myProducts'));
	Route::resource('products', 'ProductController');
});

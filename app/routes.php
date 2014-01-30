<?php

Route::get('/', function()
{
	return View::make('session.login');
});


// start public routes
Route::controller('session', 'SessionController');
Route::controller('products', 'ProductController');


// start protected routes
Route::group(array('before' => 'auth'), function(){
	Route::controller('home', 'HomeController');
});

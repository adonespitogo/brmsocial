<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		if (Auth::user()->is_admin){
			return View::make('home.admin.admin');
		}
		elseif (Auth::user()->is_vendor){
			return View::make('home.vendor.vendor');
		}
		else{
			return View::make('home.customer');
		}
	}

}
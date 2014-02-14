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
		switch (Auth::user()->type) {
			case 'admin':
			return View::make('home.admin.admin');
				break;
			case 'vendor':
			return View::make('home.vendor.index');
				break;
			case 'customer':
			return View::make('home.customer.index');
				break;
			
			default:
				return View::make('home.customer');
				break;
		}
	}

}
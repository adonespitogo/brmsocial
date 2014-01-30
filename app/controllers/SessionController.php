<?php

class SessionController extends BaseController {

	public function getLogin()
	{
		return View::make('public.login');
	}

	public function postLogin()
	{
		$user = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);

		$remember = Input::has('remember');
		if(Auth::attempt( $user, $remember )){
			return Redirect::intended('/');
		}
		else
		{
			return View::make('public.login')->with('error', true);
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function getLoginApi()
	{
		$user = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);

		if(Auth::attempt( $user, false )){
			return Auth::user();
		}
		else{
			return Response::json(false);
		}
	}

}
<?php

class SessionController extends BaseController{

	public function getLogin()
	{
		return View::make('session.login');
	}

	public function postLogin()
	{
		$user = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);
		if(Auth::attempt($user, Input::has('remember'))){
			return Redirect::intended('/home');
		}
		else
			return View::make('session.login')->with('error', true);
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('session/login');
	}

}
<?php

class RegisterController extends BaseController{

	public function updateAccount()
	{
		$creds = array(
			'email' => Input::get('email'),
			'password' => Input::get('current_password'),
		);

		$id = Input::get('id');
		$email = Input::get('email');
		$new_password = Input::get('new_password');

		if(Auth::validate($creds)){
			$user = User::find($id);
			$user->email = $email;
			$user->password = $new_password;
			$user->save();
			return $user;
		}
		return Response::make(json_encode(array(
			'error_message' => 'Invalid password', 
		)), 500);
	}
	
}
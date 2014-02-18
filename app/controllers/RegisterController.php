<?php

class RegisterController extends BaseController{

	public function updateAccount()
	{
		$creds = array(
			'email' => Auth::user()->email,
			'password' => Input::get('current_password'),
		);

		$id = Input::get('id');
		$email = Input::get('email');
		$new_password = Input::get('new_password');

		if(Auth::validate($creds)){
			
			$user = User::find($id);
			$user->email = $email;
			if(Input::has('new_password'))
				$user->password = $new_password;
			if($user->updateUniques()){
				return $user;
			}
			else{
				return Response::json($user->errors()->all(), 422);
			}
		}
		
		return Response::make(json_encode(array(
			'Invalid password', 
		)), 422);
	}
	
}
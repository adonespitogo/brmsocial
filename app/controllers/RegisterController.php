<?php

class RegisterController extends BaseController{

	// public function getIndex(){
	// 	return View::make('public.register')->with('err');
	// }

	// public function postSignup(){
		

	// 	$user = new  User();
	// 	$user->firstname = Input::get('first_name');
	// 	$user->lastname = Input::get('last_name');
	// 	$user->email = Input::get('email');
	// 	$user->password = Input::get('password');
	// 	$user->customer_type = 'ordinary';

	// 	if($user->save())
	// 	{
	// 		if(Input::get('newsletter-subscribe'))
	// 		{
	// 			$subs = new Subscriber;
	// 			$subs->user_id = $user->id;
	// 			$subs->save();
	// 		}
	// 		Auth::login($user);
	// 		return Redirect::to('services');
	// 	}
	// 	else
	// 	{
	// 		return View::make('public.register')->with('err', $user->validationErrors);
	// 	}
		
	// }

	public function passwordReset()
	{
		return View::make('public.forgot_password');
	}

	public function passwordDoReset()
	{
		
		$email = Input::get('email');
		$user = User::where('email', $email)->first();

		if(!is_null($user)) {
			
			$password = BRMHelper::genRandomPassword();
			$user->password = $password;
			$user->updateUniques();
			//send new password to user
			MailHelper::forgotPasswordMessage($user->email, $password);

			Session::flash('notice', 'Success! New password coming your way. Please check your email. <a href="'
				.URL::to('/').'">Login now.</a>');
			return View::make('public.forgot_password');

		}
		else{
			Session::flash('alert', 'Sorry, <strong>'.$email.'</strong> has no associated account yet.');
			return View::make('public.forgot_password');
		}

	}

	
}
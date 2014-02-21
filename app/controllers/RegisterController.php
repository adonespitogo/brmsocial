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
	
	public function getIndex()
	{
		return View::make('register.signup');
		
	}
	public function getFacebook()
	{
		
		$code = Input::get('code');
		
		$fb = OAuth::consumer( 'Facebook' );
		
	    if ( !empty( $code ) ) {

	        // This was a callback request from facebook, get the token
	        $token = $fb->requestAccessToken( $code );
	        // Send a request with it
	        $result = json_decode( $fb->request( '/me' ), true );
	        $result = json_decode(json_encode($result));
	        
	        $user = User::where('fb_id', $result->id)->first();
	        //if user is not yet in db, create
	        if(is_null($user)){
	        	$user = new User();
	        	$user->firstname = $result->first_name;
	        	$user->lastname = $result->last_name;
	        	$user->email = $result->email;
	        	$user->gender = ($result->gender == 'male')? 1 : 0;
	        	$user->fb_id = $result->id;
	        	$user->setPassword(BRMHelper::genRandomPassword());
	        	$user->type = 'customer';
	        	if(!$user->save()){
	        		return Redirect::to('/')->with('error', 'Sorry, there was an error encountered.');
	        	}
	        }
        	Auth::login($user, true);
	        return Redirect::to('home');

	    }
	    // if not ask for permission first
	    else {
	        // get fb authorization
	        $url = $fb->getAuthorizationUri();
	        // dd($url);
	        // return to facebook login url
	        return Redirect::to(htmlspecialchars_decode($url));
	    }
	}
	
}
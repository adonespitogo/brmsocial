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
	
	public function index()
	{
		return View::make('register.signup');
		
	}
	public function create()
	{
		$user = new User();
		$user->email = Input::get('email');
		$user->password = Input::get('password');
		$user->firstname = Input::get('firstname');
		$user->lastname = Input::get('lastname');
		$user->gender = Input::get('gender');
		$user->type = 'customer';
		if($user->save()){
			Auth::login($user, true);
			return Redirect::to('home');
		}
		else{
			return "error registering";
		}
	}
	public function registerViaFacebook()
	{
		
		$code = Input::get('code');
		
		$fb = OAuth::consumer( 'Facebook' );
		
	    if ( !empty( $code ) ) {

	        // This was a callback request from facebook, get the token
	        $token = $fb->requestAccessToken( $code );
	        // Send a request with it
	        $result = json_decode( $fb->request( '/me' ), true );
	        $result = json_decode(json_encode($result));
	        // return Response::json($result);
	        $user = User::where('fb_id', $result->id)->first();
	        //if user is not yet in db, create
	        if(is_null($user)){
	        	$user = new User();
	        	$user->setFacebookUser($result);
	        	if(!$user->save()){
	        		return Redirect::to('register')->with('error', 'Sorry, there was an error encountered.');
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
	
	public function registerViaTwitter()
	{
		$code = Input::get('code');
		
		$twitter = OAuth::consumer( 'Twitter' );
		
		if(!empty($code)){
			$token = $twitter->requestAccessToken( $code );
			$result = json_decode($twitter->request('account/verify_credentials.json'));
			dd($result);
		}
		else if(!empty($_GET['oauth_token'])){
		    // $token = $twitter->retrieveAccessToken();

		    // This was a callback request from twitter, get the token
		    $token = $twitter->getStorage()->retrieveAccessToken('Twitter');
		    
		    $twitter->requestAccessToken(
		        $_GET['oauth_token'],
		        $_GET['oauth_verifier'],
		        $token->getRequestTokenSecret()
		    );

		    // Send a request now that we have access token
		    $result = json_decode($twitter->request('account/verify_credentials.json'));
	        $result = json_decode(json_encode($result));
	        // return Response::json($result);
	        $user = User::where('twitter_id', $result->id)->first();
	        //if user is not yet in db, create
	        if(is_null($user)){
	        	$user = new User();
	        	$user->setTwitterUser($result);
	        	if(!$user->save()){
	        		return Redirect::to('register')->with('error', 'Sorry, there was an error encountered.');
	        	}
	        }
        	Auth::login($user, true);
	        return Redirect::to('home');

		}
		else{
			$token = $twitter->requestRequestToken();
			// dd($token);
	        $url = $twitter->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));
	        return Redirect::to(htmlspecialchars_decode($url));
		}
	}
	
}
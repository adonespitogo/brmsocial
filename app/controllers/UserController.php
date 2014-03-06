<?php
	class UserController extends BaseController {


		public function currentUser()
		{
			return Auth::user();
		}

		public function show($id)
		{
			return User::find($id);
		}
		public function getAll(){
			return User::where('id', '<>', Auth::user()->id)->get();
		}
		public function getUsers($type='vendor'){
			return User::where('type','=', $type)->get();
		}
		public function create(){
			return new User();
		}
		public function store(){
			$user = new User();
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->type = Input::get('type');
			$user->city = Input::get('city');
			$user->gender = Input::get('gender');
			$user->country = Input::get('country');
			$user->profession = Input::get('profession');
			$user->bio = Input::get('bio');
			$user->facebook_url = Input::get('facebook_url');
			$user->twitter_url = Input::get('twitter_url');
			$user->googleplus_url = Input::get('googleplus_url');
			$user->linkedin_url = Input::get('linkedin_url');
			$user->dribble_url = Input::get('dribble_url');
			$user->website_url = Input::get('website_url');
			if(Input::has('password')) $user->setPassword(Input::get('password'));
			$user->save();
			return $user;
		}
		public function update($id){
			$user = User::find($id);
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->type = Input::get('type');
			$user->city = Input::get('city');
			$user->gender = Input::get('gender');
			$user->country = Input::get('country');
			$user->profession = Input::get('profession');
			$user->bio = Input::get('bio');
			$user->facebook_url = Input::get('facebook_url');
			$user->twitter_url = Input::get('twitter_url');
			$user->googleplus_url = Input::get('googleplus_url');
			$user->linkedin_url = Input::get('linkedin_url');
			$user->dribble_url = Input::get('dribble_url');
			$user->website_url = Input::get('website_url');
			if(Input::has('password')) $user->password = Input::get('password');
			$user->updateuniques();
			return $user;
		}
		public function destroy($id){
			$user = User::find($id);
			$user->delete();
			return 1;
		}

		public function isUnique(){
			$val = Input::get('value');
			$field = Input::get('field');
			$user = User::where($field, '=', $val)->limit(1)->get();

			if(!isset($user[0]))
				return array('isUnique' => true);
			else
				return array('isUnique'=> false);
		}
		public function addImage()
		{
			$user = User::find(Input::get('id'));
			if(Input::hasFile('file')) $user->avatar = Input::file('file');
			$user->updateUniques();
			return $user->getProfilePic();
		}

		public function countUsers(){
			$c = User::count();
			if(is_null($c)) return Response::json(array('count' => 0));
			return Response::json(array('count' => $c));
		}
	}
?>

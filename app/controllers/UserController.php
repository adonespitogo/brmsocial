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
			return User::all();
		}
		public function getUsers($type){
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
			$user->password = Input::get('password');
			$user->save();
			return 1;
		}
		public function destroy($id){
			$user = User::find($id);
			$user->delete();
			return 1;
		}

		public function postIsUnique(){
			$val = Input::get('value');
			$field = Input::get('field');
			$user = User::where($field, '=', $val)->limit(1)->get();

			if(!isset($user[0]))
				return array('isUnique' => true);
			else
				return array('isUnique'=> false);
		}
	}
?>

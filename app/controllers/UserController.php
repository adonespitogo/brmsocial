<?php
	class UserController extends BaseController {


		public function currentUser()
		{
			return Auth::user();
		}

		public function getIndex($id=null)
		{	
			if($id){
				if($id=='create')
					return new User();
				else if($id == 'me')
					return Auth::user();
				else if($id=='all')
					return User::all();
				else	
					return User::find($id);
			}
		}

		public function postIndex($id=null){ 

			if($id)
				$user = User::find($id);
			else
				$user = new User();
			
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->type = Input::get('type');
			$user->password = Input::get('password');

			if($id)
				$user->updateuniques();
			else
				$user->save(); 

			if(!empty($user->validationErrors))
				foreach ($user->validationErrors->all() as $key => $error) {
					echo $error;
				}
			else
				echo '1';
		}
		public function deleteIndex($id){
			$user = User::find($id);
			$user->delete();
			return 1;
		}
		public function postCheck(){
			$field = Input::get('field');
			$val = Input::get('value'); 
			$user = User::where($field, $val)->first(); 
			if(isset( $user->id))
				return Response::json(array('isUnique'=>false));
			else
				return Response::json(array('isUnique'=>true,'user'=>$user));
		}
	}
?>

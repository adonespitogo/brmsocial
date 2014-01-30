<?php
	class UserController extends BaseController {

		public function postChangePassword() {
			//BRMHelper::printR(Input::all());

			$current_pass_frm_db = Auth::user()->password;
			$old_pass_input = Input::get('old_pass');
			$new_pass_input = Input::get('new_pass');
			$confirm_input = Input::get('confirm_pass');

			if($new_pass_input != $confirm_input) return json_encode(array('status' => 'New password and the confirmation did not match.'));

			if(Hash::check($old_pass_input, $current_pass_frm_db)) {
				$user = Auth::user();
				$user->password = $confirm_input;								
				$user->updateUniques();

				$status = 'success';
			}else $status = 'Wrong old password';

			return json_encode(array('status' => $status));

		}

		public function getUserForm(){
			return "<form method='POST' action=".URL::to('user/create-user-by-api').">
				<input type='text' name='email'>
				<input type='text' name='password'>
				<button>create</button>
			</form>";
		}
		
		public function createUserByApi()
		{
			$email = Input::get('email');
			$user = User::where('email', $email)->first();
			if(is_null($user)){
				$password = Input::get('password');
				$user = array(
					'customer_type' => 'Ordinary',
					'email' => $email,
					'password' => Hash::make($password),
					'firstname' => '',
					'lastname' => '',
					'fund' => '0.00',
					'status' => 'active',
					'created_at' => date('Y:m:d 00:00:00'),
					'updated_at' => date('Y:m:d 00:00:00')
				);
				User::insert(
					array($user)
				);
				$user = User::where('email', $email)->first();
			}
			return $user->id;
			return 'naa';
		}

	}
?>

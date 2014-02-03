<?php
	class UserController extends BaseController {


		public function currentUser()
		{
			return Auth::user();
		}

	}
?>

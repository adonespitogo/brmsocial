<?php

	class InterestController extends BaseController {

		public function index() {
			return Interest::all();
		}

		public function myInterest() {
			return Auth::user()->interests;
		}

		public function updateUserInterest() {

			$user_interest = Auth::user()->user_interests()->where('interest_id', Input::get('id'))->first();
			if(is_object($user_interest)) {
				$user_interest->delete();
			}else {
				$user_interest = new UserInterest();
				$user_interest->user_id 		= Auth::user()->id;
				$user_interest->interest_id		= Input::get('id');
				$user_interest->save();
			}
			// return $user_interest;

		}

	}

?>
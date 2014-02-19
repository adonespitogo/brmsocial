<?php

	class InterestController extends BaseController {

		public function index() {
			return Interest::all();
		}

		public function myInterest() {
			return Auth::user()->interests;
		}

	}

?>
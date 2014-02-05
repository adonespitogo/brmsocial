<?php

	class CommissionController extends BaseController {

		public function myReceivableCommission() {
			$commission = Auth::user()->getMyReceivableCommission();
			return Response::json(array('commission' => $commission));
		}

	}

?>
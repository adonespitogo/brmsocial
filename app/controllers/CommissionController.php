<?php

	class CommissionController extends BaseController {

		public function unpaidCommissions()
		{
			return Auth::user()->unpaidCommissions();
		}

		public function paidCommissions()
		{
			return Auth::user()->paidCommissions();
		}

		public function myReceivableCommission() {
			$commission = Auth::user()->getMyReceivableCommission();

			return Response::json(array('commission' => $commission));
		}

		public function myReceivedCommission() {
			$commission = Auth::user()->getMyReceivedCommission();

			return Response::json(array('commission' => $commission));
		}

	}

?>
<?php

	class CommissionController extends BaseController {

		public function myReceivableCommission() {
			$commission = Auth::user()->getMyReceivableCommission();

			$commission = is_numeric($commission) ? $commission : 0;

			return Response::json(array('commission' => $commission));
		}

	}

?>
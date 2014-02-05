<?php

	class OrderController extends BaseController {

		public function myOrdersSoldTodayCount() {
			$orders_today = Auth::user()->getMyOrdersSoldTodayCount();
			return Response::json(array('orderstoday' => $orders_today));
		}

	}

?>
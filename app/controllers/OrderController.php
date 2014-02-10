<?php

	class OrderController extends BaseController {

		public function myOrdersSoldTodayCount() {
			$orders_today = Auth::user()->getMyOrdersSoldTodayCount();
			return Response::json(array('orderstoday' => $orders_today));
		}

		public function mySalesToday() {
			$sales_today = Auth::user()->getMySalesToday();
			return Response::json(array('salestoday' => $sales_today));
		}

		public function myOrdersList() {
			
			$orders = Auth::user()->orders;
			return $orders;
			//return Response::json(array('orders' => $orders));
		}

		public function mySalesList() {
			return Auth::user()->sales;
		}

	}

?>
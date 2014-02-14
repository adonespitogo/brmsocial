<?php

	class TrafficController extends BaseController {

		public function show($id) {

			$product = new Product();
			return $product->getProductTraffic($id);

		}

	}

?>
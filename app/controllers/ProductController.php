<?php

	class ProductController extends BaseController {

		public function getFeaturedProduct() {
			$datenow = date("Y-m-d H:i:s");
			$featuredproduct = FeaturedProduct::getFeaturedProducts();
			return $featuredproduct;

		}
	}

?>
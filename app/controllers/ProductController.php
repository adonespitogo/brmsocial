<?php

	class ProductController extends BaseController {

		public function index()
		{
			return Product::all();
		}

		public function getFeaturedProduct() {
			$datenow = date("Y-m-d H:i:s");
			$featuredproduct = FeaturedProduct::getFeaturedProducts();
			return $featuredproduct;

		}
	}

?>
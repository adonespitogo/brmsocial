<?php

	class ProductController extends BaseController {

		public function index()
		{
			return Product::all();
		}

		public function myProducts()
		{
			return Auth::user()->products;
		}

		public function featuredProducts()
		{

			$featuredproduct = FeaturedProduct::getFeaturedProducts();
			return $featuredproduct;

		}
	}

?>
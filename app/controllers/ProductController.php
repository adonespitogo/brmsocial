<?php

	class ProductController extends BaseController {

		public function myProducts()
		{
			return Auth::user()->products;
		}

		public function featuredProducts()
		{

			$featuredproduct = FeaturedProduct::getFeaturedProducts();
			return $featuredproduct;

		}

		public function myActiveProducts() {
			return Auth::user()->getMyActiveProducts();
		}

		public function myActiveProductsCount() {
			$count = Auth::user()->getMyActiveProductsCount();
			return Response::json(array('count' => $count));
		}


	}

?>
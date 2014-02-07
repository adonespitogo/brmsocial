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

		public function myActiveProducts() {
			return Auth::user()->getMyActiveProducts();
		}

		public function myActiveProductsCount() {
			$count = Auth::user()->getMyActiveProductsCount();
			return Response::json(array('count' => $count));
		}

		public function productTraffic($id) {

			$product = Product::find($id);

			$traffic = $product->getProductTraffic($product->id);


			$product_name = new stdClass();
			$product_name->name = $product->product_name;

			return Response::json(array('traffic' => $traffic, 'product_name' => $product_name));
		}


	}

?>
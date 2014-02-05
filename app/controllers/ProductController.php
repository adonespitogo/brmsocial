<?php

	class ProductController extends BaseController {

		public function index()
		{
			return Product::all();
		}

		public function show($id)
		{
			return Product::find($id);
		}

		public function update($id)
		{
			$p = Product::find($id);
			$p->sale_start_date = Input::get('sale_start_date');
			$p->save();
			return $p;
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


	}

?>
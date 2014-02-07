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
			$p->category_id = Input::get('category_id');
			$p->product_name = Input::get('product_name');
			$p->tagline = Input::get('tagline');
			$p->regular_price = Input::get('regular_price');
			$p->discounted_price = Input::get('discounted_price');
			$p->sale_start_date = Input::get('sale_start_date');
			$p->sale_end_date = Input::get('sale_end_date');
			$p->product_image = Input::get('product_image');
			$p->overview = Input::get('overview');
			$p->save();
			return $p;
		}

		public function destroy($id)
		{
			Product::where('id', $id)->delete();
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
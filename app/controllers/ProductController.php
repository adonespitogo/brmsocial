<?php

	class ProductController extends BaseController {

		public function index()
		{
			return Product::all();
		}

		public function create()
		{
			return new Product();
		}

		public function store()
		{

			$p = new Product();
			$p->category_id = Input::get('category_id');
			$p->product_name = Input::get('product_name');
			$p->tagline = Input::get('tagline');
			$p->regular_price = Input::get('regular_price');
			$p->discounted_price = Input::get('discounted_price');
			$p->sale_start_date = Input::get('sale_start_date_iso_date');
			$p->sale_end_date = Input::get('sale_end_date_iso_date');
			$p->overview = Input::get('overview');
			$p->save();
			  
			foreach (Input::file() as $key => $picture) {
				$pPicture = new ProductPicture();             
   				$pPicture->picture = $picture; 
				$p->pictures()->save($pPicture);
			}
		 

			return $p;
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
			$p->sale_start_date = Input::get('sale_start_date_iso_date');
			$p->sale_end_date = Input::get('sale_end_date_iso_date'); 
			$p->overview = Input::get('overview');
			$p->save();

			if(Input::hasFile('product_image_0')){
				foreach ($p->pictures as $key => $p) {
					$p->picture->destroy();
					$p->delete();
				}
			}
			foreach (Input::file() as $key => $picture) {
				$pPicture = new ProductPicture();             
   				$pPicture->picture = $picture; 
				$p->pictures()->save($pPicture);
			}

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

			$traffic = $product->getProductTraffic();

			

			$product_name = new stdClass();
			$product_name->name = $product->product_name;

			return Response::json(array('traffic' => $traffic, 'product_name' => $product_name));
		}


	}

?>
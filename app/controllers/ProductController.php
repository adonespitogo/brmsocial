<?php

	class ProductController extends BaseController {

		public function getIndex($id=null)
		{		
			if($id)
				if($id == 'create')
					return new Product();
				else{
					// return Product::find($id);
					$product = Product::find($id);
					return $product;// $images = $product->pictures;

					// foreach ($images as $key => $img) {
					// 	echo $img->picture->url('medium');
					// }
					
				}
			else
				return Product::all();
		}

		public function postIndex($id=null)
		{
			$id = ($id) ? $id : Input::get('id');

			if($id)
				$p = Product::find($id);
			else
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
			 
			if(Input::has('terms')){
				$terms = Input::get('terms');
				$terms = explode(',', $terms);
				 
				foreach ($terms as $key => $t) {
					$term = new Term();
					$term->product_id = $p->id;
					$term->term = $t;
					$term->save();
				}
			}
 		
			foreach (Input::file() as $key => $picture){
				$pPicture = new ProductPicture();             
   				$pPicture->picture = $picture;
   				$p->pictures()->delete();
				$p->pictures()->save($pPicture);
			}
		 

			return $p;
		}
				
		public function deleteIndex($id)
		{
			Product::find($id)->delete();
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
			$product->loadProductTraffic();
			return $product;

		}


	}

?>
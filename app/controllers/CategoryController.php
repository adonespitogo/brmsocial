<?php

	class CategoryController extends BaseController {

		public function Index()
		{	
			$category = Category::all();
			return $category;
		}	

		public function create(){
			return new Category();
		}
		public function show($id){
			if($id=='create')
				return new Category();

			return Category::find($id);
		}

		public function store(){
			$cat = new Category();
			$cat->category = Input::get('category');
			$cat->save();
			return $cat;
		}
		public function update($id){
			$cat = Category::find($id);
			$cat->category = Input::get('category');
			$cat->update();
			return 1;
		} 
		public function destroy($id){
			$cat = Category::find($id);
			$cat->delete();

			return 1;
		}

		public function getProducts($slug) {

			$category = Category::where('slug', $slug)->first();

			$products = $category->products;

			return View::make('public.product_list', [
					'products' => $products
				])->with('category', $category);
		}

		public function productByCategory($cat_slug)
		{
			$cat = Category::where('slug', $cat_slug)->first();
			
			if(is_null($cat))
				$this->show404();
			
			return $cat->products;
		}
		public function countCategories(){
			$return = Category::count();
			if(is_null($return)) return 0;
			return $return;
		}
	}

?>
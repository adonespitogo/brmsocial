<?php

	class CategoryController extends BaseController {

		public function Index()
		{	
			$category = Category::all();
			return $category;
		}	

		public function show($id){
			$category = Category::find($id);
			return $category;
		}

		public function save(){
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
	}

?>
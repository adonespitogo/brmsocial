<?php

	class CategoryController extends BaseController {

		public function getIndex($id=null)
		{	
			if($id)
				return Category::find($id);
			else
				return Category::all();
		}	
		public function getCreate(){
			return new Category();
		}
		
		public function postIndex($id=null){
			$id = ($id) ? $id : Input::get('id');
			if($id)
				$cat = Category::find($id); 
			else
				$cat = new Category();

			$cat->category = Input::get('category');
			$cat->save();
			return 1;
		}
		public function deleteIndex($id=null){
			$cat = Category::find($id);
			$cat->delete();
			return 1;
		}

	}

?>
<?php

class ProductType extends BaseModel{
	
	protected $table = 'product_types';
	 
	 public function products(){
	 	return $this->hasMany('Product');
	 }
}
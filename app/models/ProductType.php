<?php

class ProductType extends BaseModel{
	 
	 public function products(){
	 	return $this->hasMany('Product');
	 }
}
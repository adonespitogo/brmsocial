<?php

// use LaravelBook\Ardent\Ardent;

class Category extends BaseModel{

	protected $table = 'categories';
	protected $softDelete = true;

	protected $isodates = array('created_at');

	public function products(){
		return $this->hasMany('Product');
	}
}

?>
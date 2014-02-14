<?php

// use LaravelBook\Ardent\Ardent;

class Category extends BaseModel{

	protected $table = 'categories';
	protected $softDelete = true;

	protected $isodates = array('created_at');
	protected $hasSlug = array(
		'slugColumn' => 'slug',
		'slugFromColumn' => 'category'
	);

	public function products(){
		return $this->hasMany('Product');
	}
}

?>
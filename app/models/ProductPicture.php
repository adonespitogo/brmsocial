<?php
class ProductPicture extends Ardent(){
	use Codesleeve\Stapler\Stapler;

	public function __construct(array $attributes =  array()){
		$this->hasAttachedFile('picture', [
			'styles' => [
				'medium' => '300x300',
				'small' =>'100x100'
			]
		]);
	}

	public function product(){
		return $this->belongsTo('Product');
	}
}
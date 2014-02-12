<?php
use LaravelBook\Ardent\Ardent;
class ProductPicture extends Ardent{

	use Codesleeve\Stapler\Stapler;

	public function __construct(array $attributes =  array()){
		$this->hasAttachedFile('picture', [
			'styles' => [
				'medium' => '300x300',
				'small' =>'100x100'
			],
			'url' => '/system/:attachment/:id_partition/:style/:filename',
        	'default_url' => '/:attachment/:style/missing.jpg'
		]);
	}

	public function product(){
		return $this->belongsTo('Product');
	}
}
<?php
use LaravelBook\Ardent\Ardent;
class ProductPicture extends Ardent{
	use Codesleeve\Stapler\Stapler;

	public function __construct(array $attributes =  array()){
		$this->hasAttachedFile('picture', [
			'styles' => [
				'medium' => '220x220',
				'small' =>'100x100'
			],
			//'content_type' => 'jpg,png',
        	'default_url' => '/:attachment/:style/missing.jpg',
        	'keep_old_files' => true
		]);

		parent::__construct($attributes);
	}
	// protected $contentType = array('image/jpg','jpg','png');

	public function product(){
		return $this->belongsTo('Product');
	}

}
<?php
use LaravelBook\Ardent\Ardent;
class ProductFile extends Ardent{
	use Codesleeve\Stapler\Stapler;

	public function __construct(array $attributes =  array()){
		$this->hasAttachedFile('file', [
        'url' => '/product/:attachment/:id_partition/:filename',
        'path' => ':laravel_root/app/storage:url',
        'keep_old_files' => true
    ]);
		parent::__construct($attributes);
	}

	public function product(){
		return $this->belongsTo('Product');
	}
}
<?php

use LaravelBook\Ardent\Ardent;

class VendorInfo extends Ardent{

	protected $table = 'vendor_info';
	protected $softDelete = true;

	public static $relationsData = array(
		'user' => array(self::BELONGS_TO, 'User'),
	);

}

?>
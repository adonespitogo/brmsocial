<?php

use LaravelBook\Ardent\Ardent;

class Subscriber extends Ardent{

	protected $table = 'subscribers';
	protected $softDelete = true;
}

?>
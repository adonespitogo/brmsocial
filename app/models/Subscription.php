<?php

class Subscription extends BaseModel{
	
	protected $table = "subscriptions";
	
	public static $relationsData = array(
		'user' => array(self::BELONGS_TO, 'User'),
	);
	
}
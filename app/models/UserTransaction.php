<?php

class UserTransaction extends BaseModel{
	protected $table = 'user_transactions';
	
	
	public static $relationsData = array(
		'user' => array(self::BELONGS_TO, 'User')
	);
	
	
}
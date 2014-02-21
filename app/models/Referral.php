<?php

class Referral extends BaseModel{
	protected $table = 'referrals';
	
	public static $rules = array(
		'email' => 'required|email|unique:referrals'
	);
	
	public static $relationsData = array(
		'user' => array(self::BELONGS_TO, 'User'),
	);
	
	public function afterCreate()
	{
		MailHelper::referralMessage($this->email, $this->user);
	}
}
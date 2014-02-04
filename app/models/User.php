<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $softDelete = true;

    protected $rawPassword;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */

    public static $rules = array(
        'email'                 => 'required|email|unique:users',
        'password'              => 'required'
    );

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    // START RELATIONSHIPS======================================


    public static $relationsData = array(
    	'orders' => array(self::HAS_MANY, 'Order'),
    	'products' => array(self::HAS_MANY, 'Product'),
    	'vendorInfo' => array(self::HAS_ONE, 'VendorInfo'),
    );
    

    // END RELATIONSHIPS

    // start overrides
    public function toArray()
    {
    	$this->fullname = $this->getFullname();
    	if((bool)$this->is_vendor)
    		$this->load('vendorInfo');

    	return parent::toArray();
    }
    // start custom functions
    public function getFullname()
    {
    	return $this->firstname . ' '. $this->lastname;
    }

}
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
    	'commissions' => array(self::HAS_MANY, 'Commission')
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

    //vendor
    public function getMyActiveProducts() {
    	$datenow = date("Y-m-d H:i:s");
		return $this->products()->where('sale_start_date', '<=', $datenow)
						->where('sale_end_date', '>=', $datenow)
						->get();	
	}

	//vendor
	public function getMyActiveProductsCount() {
    	$datenow = date("Y-m-d H:i:s");
		return $this->products()->where('sale_start_date', '<=', $datenow)
						->where('sale_end_date', '>=', $datenow)
						->count();	
	}

	//vendor
	public function getMyOrdersSoldTodayCount() {
		$id = $this->id;
		$orders = DB::select(DB::raw("SELECT COUNT(id) AS orders_today FROM orders WHERE created_at >= CONCAT(CURDATE(), ' 00:00:00') AND created_at <=  CONCAT(CURDATE(), ' 23:59:59') AND user_id=".$id));
		return $orders[0]->orders_today;
	}

	//vendor
	public function getMySalesToday() {
		$id = $this->id;
		$sales = DB::select(DB::raw("SELECT SUM(price) AS sales_today FROM orders WHERE created_at >= CONCAT(CURDATE(), ' 00:00:00') AND created_at <=  CONCAT(CURDATE(), ' 23:59:59') AND user_id=".$id));
		return $sales[0]->sales_today;
	}

	//vendor
	public function getMyReceivableCommission() {
		return $this->commissions()->where('is_paid', 0)->sum('commission');
	}

}
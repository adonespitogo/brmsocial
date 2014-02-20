<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends BaseModel implements UserInterface, RemindableInterface {
	
    use Codesleeve\Stapler\Stapler;

	public function __construct($attributes = array()) {
		
		$this->hasAttachedFile('avatar', [
		  'styles' => [
		    'medium' => '300x300',
		    'thumb' => '100x100'
		  ]
		]);

		parent::__construct($attributes);
	}
	
	protected $table = 'users';
    protected $softDelete = true;

    protected $appends = array('created_at_iso_date');

    protected $rawPassword;
    
	public static $passwordAttributes  = array('password');
	public $autoHashPasswordAttributes = true;

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
    	'commissions' => array(self::HAS_MANY, 'Commission'),
    	'sales' => array(self::HAS_MANY, 'Order', 'foreignKey' => 'vendor_id'),
    	'subscriptions' => array(self::HAS_ONE, 'Subscription'),
    	'user_interests' => array(self::HAS_MANY, 'UserInterest'),
    	'interests' => array(self::BELONGS_TO_MANY, 'Interest', 'table' => 'user_interests')
    );

    // END RELATIONSHIPS

    // start overrides
    public function toArray()
    {
    	$this->fullname = $this->getFullname();
    	$this->pic = $this->getProfilePic();
    	if($this->type == 'vendor')
    		$this->load('vendorInfo');

    	return parent::toArray();
    }
    // start custom functions
    public function getFullname()
    {
    	return $this->firstname . ' '. $this->lastname;
    }
    
    public function getProfilePic()
    {
    	return URL::to($this->avatar->url('medium'));
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
		$orders = DB::select(DB::raw("SELECT COUNT(id) AS orders_today FROM orders WHERE created_at >= CONCAT(CURDATE(), ' 00:00:00') AND created_at <=  CONCAT(CURDATE(), ' 23:59:59') AND vendor_id=".$id));
		return $orders[0]->orders_today;
	}

	//vendor
	public function getMySalesToday() {
		$id = $this->id;
		$sales = DB::select(DB::raw("SELECT CASE WHEN SUM(price) IS NOT NULL THEN SUM(price) ELSE 0 END AS sales_today FROM orders WHERE created_at >= CONCAT(CURDATE(), ' 00:00:00') AND created_at <=  CONCAT(CURDATE(), ' 23:59:59') AND vendor_id=".$id));
		return $sales[0]->sales_today;
	}

	//vendor
	public function getMyReceivableCommission() {
		$sum = $this->commissions()->where('is_paid', 0)->sum('commission');
		if(!is_numeric($sum)) return 0.00;
		return $sum;
	}

	//vendor
	public function getMyReceivedCommission() {
		$sum = $this->commissions()->where('is_paid', 1)->sum('commission');
		if(!is_numeric($sum)) return 0.00;
		return $sum;
	}

	//vendor
	public function unpaidCommissions()
	{
		return $this->commissions()->where('is_paid', 0)->get();
	}
	//vendor
	public function paidCommissions()
	{
		return $this->commissions()->where('is_paid', 1)->get();
	}

	public function getCreatedAtIsoDateAttribute(){
		if(is_object($this->created_at) && get_class($this->created_at) == "Carbon\Carbon"){
			return $this->created_at->toISO8601String();
		} 
	}
	
	public function afterCreate()
	{
		$s = new Subscription();
		$s->user_id = $this->id;
		$s->save();
	}

	//new user
	// public function beforeSave()
 //    {
 //    	dd('before save');
 //        $this->rawPassword = $this->password;
 //        // if there's a new password, hash it
 //        if($this->isDirty('password')) {
        	
 //            $this->password = Hash::make($this->password);
 //        }

 //        return true;
 //        //or don't return nothing, since only a boolean false will halt the operation
 //    }
}
<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends BaseModel implements UserInterface, RemindableInterface {
	
    use Codesleeve\Stapler\Stapler;

	public function __construct($attributes = array()) {
		
		$this->hasAttachedFile('avatar', [
		  'styles' => [
		    'medium' => '300x300#',
		    'thumb' => '100x100#'
		  ]
		]);

		parent::__construct($attributes);
		
		$this->avatar = URL::to("customer/images/default_profile_pic.jpg");
		$this->profile_img = "";
		$this->city = "";
		$this->country = "";
		$this->bio = "";
		$this->profession = "";
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
    	'interests' => array(self::BELONGS_TO_MANY, 'Interest', 'table' => 'user_interests'),
    	'referrals' => array(self::HAS_MANY, 'Referral'),
    	'transactions' => array(self::HAS_MANY, 'UserTransaction'),
    );

    // END RELATIONSHIPS

    // start overrides
    public function toArray()
    {
    	$this->fullname = $this->getFullname();
    	$this->pic = $this->getProfilePic();
    	$this->credits = number_format($this->getCredits(), 0);
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
	
	public function getTotalReferralEarned()
	{
		$earned = $this->transactions()->where('type', 'referral_reward')->sum('amount');
		if(is_null($earned)) 
			return 0;
		return number_format($earned, 0);
	}
	
	public function getTotalReferral()
	{
		$total = $this->referrals()->where('joined', true)->count();
		if(is_null($total)) return 0;
		return (int)$total;
	}
	
	public function getCredits()
	{
		$credits = $this->transactions()->where('is_credit', true)->sum('amount');
		if(is_null($credits)) return 0;
		$deductions = $this->transactions()->where('is_credit', false)->sum('amount');
		if(is_null($deductions)) return $credits;
		return $credits - $deductions;
	}
	
	public function getSpentCredits()
	{
		$spent = $this->transactions()->where('is_credit', false)->sum('amount');
		if(is_null($spent)) return 0;
		return number_format($spent, 0);
	}
	
	public function getFriendsWhoJoined()
	{
		$emails = $this->referrals()->select('email')->where('joined', true)->get();
		if(count($emails->toArray()) == 0) return array();
		$es = array();
		foreach ($emails as $e) {
			$es[] = $e->email;
		}
		return User::whereIn('email', $es)->get();
	}
	
	public function createSubscriptionEntry()
	{
		$s = new Subscription();
		$s->user_id = $this->id;
		$s->save();
	}

	public function setPassword($p)
	{
		$this->rawPassword = $p;
		$this->password = $p;
	}
	
	public function checkIfReferred()
	{
		$referred = Referral::where('email', $this->email)->first();
		if(!is_null($referred) && (boolean)$referred->joined == false){
			$referred->joined = true;
			$referred->updateUniques();
			
			$ut = new UserTransaction();
			$ut->user_id = $referred->user_id;
			$ut->amount = 10;
			$ut->remarks = 'Referral Reward';
			$ut->type = 'referral_reward';
			$ut->transaction_id = BRMHelper::genRandomTransactionId();
			$ut->is_credit = true;
			$ut->save();
		}
	}
	
	public function sendReferrals($emails)
	{
		foreach ($emails as $e) {
			$ref = new Referral();
			$ref->email = $e;
			$ref->user_id = $this->id;
			$ref->save();
		}
	}
	
	public function isFacebookUser()
	{
		return (isset($this->fb_id) && $this->fb_id != '');
	}
	
	public function setFacebookUser($result)
	{
    	$this->fb_id = $result->id;
		$this->avatar = $this->getFBPic();
    	$this->firstname = $result->first_name;
    	$this->lastname = $result->last_name;
    	$this->email = $result->email;
    	$this->gender = ($result->gender == 'male')? 1 : 0;
    	$this->setPassword(BRMHelper::genRandomPassword());
    	$this->type = 'customer';
	
	}
	
	public function setTwitterUser($result)
	{
    	$this->twitter_id = $result->id;
		$this->avatar = $this->getTwitterPic($result);
    	$this->firstname = $this->getTwitterFirstname($result);
    	$this->lastname = $this->getTwitterLastname($result);
    	$this->email = $result->screen_name.'@twitter.com';
    	$this->gender = 1; //set to male
    	$this->setPassword(BRMHelper::genRandomPassword());
    	$this->type = 'customer';
	
	}
	
	protected function getTwitterFirstname($result)
	{
		$ex = explode(' ', $result->name);
		return isset($ex[0]) ? $ex[0] : 'undefined';
	}
	
	protected function getTwitterLastname($result)
	{
		$ex = explode(' ', $result->name);
		return isset($ex[1]) ? $ex[1] : 'undefined';
	}
	
	protected function getFBPic()
	{
		$data = file_get_contents('http://graph.facebook.com/'.$this->fb_id.'/picture?type=large&redirect=false');
		$url = json_decode($data)->data->url;
		return $url;
	}
	
	protected function getTwitterPic($result)
	{
		return str_replace('_normal', '_bigger', $result->profile_image_url);
	}
	
	public function isTwitterUser()
	{
		return (isset($this->twitter_id) && $this->twitter_id != '');
	}
	
	public function afterCreate()
	{
		if($this->type == 'customer'){
			$this->createSubscriptionEntry();

			$this->checkIfReferred();
			MailHelper::signupMessage($this->getFullname(), $this->email, $this->rawPassword);
		}
	}
	public function afterSave()
	{
		if($this->type == 'customer' && is_null($this->subscriptions))
		{
			$this->createSubscriptionEntry();
		}
	}

	public function beforeDelete()
	{
		$this->subscriptions->delete();
	}
}
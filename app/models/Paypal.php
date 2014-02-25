<?php
	use LaravelBook\Ardent\Ardent;

	class Paypal extends Ardent{
			/**
	     * object to authenticate the call.
	     * @param object $_apiContext
	     */
	    private $_apiContext;

	    /**
	     * Set the ClientId and the ClientSecret.
	     * @param 
	     *string $_ClientId
	     *string $_ClientSecret
	     */
	    private $_ClientId;
	    private $_ClientSecret;
	    private $_mode;

	    /*
	     *   These construct set the SDK configuration dynamiclly, 
	     *   If you want to pick your configuration from the sdk_config.ini file
	     *   make sure to update you configuration there then grape the credentials using this code :
	     *   $this->_cred= Paypalpayment::OAuthTokenCredential();
	    */
	    public function __construct()
	    {

	        // ### Api Context
	        // Pass in a `ApiContext` object to authenticate 
	        // the call. You can also send a unique request id 
	        // (that ensures idempotency). The SDK generates
	        // a request id if you do not pass one explicitly. 
	    	$this->initConfig();

	        $this->_apiContext = Paypalpayment::ApiContext(
	            Paypalpayment::OAuthTokenCredential(
	                $this->_ClientId,
	                $this->_ClientSecret
	            )
	        );

	        // Uncomment this step if you want to use per request 
	        // dynamic configuration instead of using sdk_config.ini

	        $this->_apiContext->setConfig(array(
	            'mode' => $this->_mode,
	            'http.ConnectionTimeOut' => 30,
	            'log.LogEnabled' => true,
	            'log.FileName' => __DIR__.'/../PayPal.log',
	            'log.LogLevel' => 'FINE'
	        ));

	    }

	    public static function initConfig(){
	    	$ipaddress = Location::getIp();
	 

	        if($ipaddress=='202.78.93.154'||$ipaddress=='122.3.199.205'||strpos($_SERVER['HTTP_HOST'], "localhost")!==false||$ipaddress=='121.96.56.8'||$ipaddress=='121.96.56.9'){
	            $_ClientId='AcarHxDSgebv8p9qrbXstNVGdootR7yaU2iPEb5kVYgj_a26kIKXernEmNrt';
				$_ClientSecret='EEHOlhDfLAuyecXjF7zM0sRkiDyFBCbALPM2ByGAYMF6nnYWlzYvVXXE9io1';
				$_mode = 'sandbox'; 
	        }else{
	            $_ClientId='AcarHxDSgebv8p9qrbXstNVGdootR7yaU2iPEb5kVYgj_a26kIKXernEmNrt';
				$_ClientSecret='EEHOlhDfLAuyecXjF7zM0sRkiDyFBCbALPM2ByGAYMF6nnYWlzYvVXXE9io1';
				$_mode = 'live'; 
	        }

	    }
	}
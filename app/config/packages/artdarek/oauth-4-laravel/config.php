<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '1405919609664344',
            'client_secret' => 'df13f952d4407ec2716dd5bf33ea19ad',
            'scope'         => array('email','read_friendlists'),
        ),		

	)

);
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
        	
        'Twitter' => array(
            'client_id'     => 'TmYAii9l0Bt0h7fowdBM9g',
            'client_secret' => '4Psi3nKNxZD9N5FmU5esKHVSnWtSfzaI2gcPaCO7Jcg',
            // 'scope'         => array('email','read_friendlists'),
        ),		

	)

);
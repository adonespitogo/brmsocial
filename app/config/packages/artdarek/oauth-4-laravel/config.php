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
            'client_id'     => '641816635878156',
            'client_secret' => 'f566e0a021bd93829e043b2185e759ca',
            'scope'         => array('email','publish_actions'),
        ),	
        	
        'Twitter' => array(
            'client_id'     => 'TmYAii9l0Bt0h7fowdBM9g',
            'client_secret' => '4Psi3nKNxZD9N5FmU5esKHVSnWtSfzaI2gcPaCO7Jcg',
            // 'scope'         => array('email','read_friendlists'),
        ),		

	)

);
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
        'Google' => array(
            'client_id'     => '770774477781-ij9l2nd57cp58130698fippismo36ao4.apps.googleusercontent.com',
            'client_secret' => 'xcF3X6QigmE81HwSpzEoQuwf',
            'scope'         => array('userinfo_profile'),
        ),		

	)

);
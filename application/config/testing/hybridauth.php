<?php defined('BASEPATH') OR exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| Hybridauth Config
|--------------------------------------------------------------------------
|
| Every social oauth credentials
|
*/
$config['hybridauth_config'] = array(
		"base_url" => site_url('authe/login-social-base'),

		"providers" => array (
			// openid providers
			// "OpenID" => array (
			// 	"enabled" => true
			// ),

			// "Yahoo" => array (
			// 	"enabled" => true,
			// 	"keys"    => array ( "key" => "", "secret" => "" ),
			// ),

			// "AOL"  => array (
			// 	"enabled" => true
			// ),

			"Google" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ),
				"scope"   => "email",
				"trustForwarded" => false
			),

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			// windows live
			// "Live" => array (
			// 	"enabled" => true,
			// 	"keys"    => array ( "id" => "", "secret" => "" )
			// ),

			// "LinkedIn" => array (
			// 	"enabled" => true,
			// 	"keys"    => array ( "key" => "", "secret" => "" )
			// ),

			// "Foursquare" => array (
			// 	"enabled" => true,
			// 	"keys"    => array ( "id" => "", "secret" => "" )
			// ),
		),

		// If you want to enable logging, set 'debug_mode' to true.
		// You can also set it to
		// - "error" To log only error messages. Useful in production
		// - "info" To log info and error messages (ignore debug messages)
		"debug_mode" => true,

		// Path to file writable by the web server. Required if 'debug_mode' is not false
		"debug_file" => APPPATH . '/logs/hybridauth.log',
	);

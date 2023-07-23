<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------


if ( ! function_exists('hash_password')) {
	function hash_password($password) {
		$options = array(
		    'cost' => 11,
		);
		$password = trim(strip_tags(stripslashes($password)));
		return password_hash($password, PASSWORD_BCRYPT, $options);
	}

}



?>
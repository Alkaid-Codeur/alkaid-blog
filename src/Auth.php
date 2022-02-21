<?php 

namespace App;

class Auth {

	public static function checkAuthentification()
	{
		if(session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		if(!isset($_SESSION['auth'])) {
			throw new AuthException();
		}
	}
}
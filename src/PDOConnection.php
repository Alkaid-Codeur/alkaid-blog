<?php

namespace App;

class PDOConnection {

	public static function getPDO () : \PDO
	{
		return new \PDO('mysql:host=127.0.0.1; dbname=myblog', 'root', '', [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
		]);
	}
}
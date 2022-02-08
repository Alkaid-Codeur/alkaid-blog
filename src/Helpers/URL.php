<?php 

namespace App\Helpers;

use Exception;

class URL {
	public static function getInt(string $name, int $default) {
		if(!isset($_GET[$name])) return $default;
		if(!filter_var($_GET[$name], FILTER_VALIDATE_INT) || (int)$_GET[$name] <= 0) {
			throw new Exception("Le parametre '$name' dans l'URL n'est pas un entier");
		}
		return (int)$_GET[$name];
	}

	public static function handleSlugInURL($slug, $indexSlug, $url)
	{
		if($slug !== $indexSlug) {
			http_response_code(301);
			header('Location:'.$url);
		}
	}
}
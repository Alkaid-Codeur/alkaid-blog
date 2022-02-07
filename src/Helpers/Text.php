<?php

namespace App\Helpers;

class Text {
	public static function excerpt(string $text, int $limit = 60)
	{
		if(mb_strlen($text) <= $limit)
		{
			return $text;
		}
		$lastSpace = mb_strpos($text, ' ', $limit);
		return mb_substr($text, 0, $lastSpace) . ' ...';
	}
}
<?php

class Helper {
	public static function getRealIpAddr() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		} else {
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip=$_SERVER['REMOTE_ADDR'];
			}
		}
		return $ip;
	}

	public static function removeSpaces ($str) {
		return preg_replace('/\s\s+/', ' ', trim($str));
	}

	public static function conv4send ($string) {	//	converts STRING for SITE-showing
		// return iconv("UTF-8", "CP1251", $string);
		return iconv("CP1251", "UTF-8", $string);
	}
}
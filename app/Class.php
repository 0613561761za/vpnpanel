<?php 

namespace Color;

use App\VPN;
use App\SSH;


class Color {

	public static function random()
	{
		$input = ['primary', 'success', 'warning', 'danger'];
		$key   = array_rand($input, 2);
		return $input[$key[0]];
	}

	public static function explode($string)
	{
		$s = explode("|", $string);

		return array_values($s);
	}

	public static function account()
	{
		$ssh = SSH::get()->count();
		$vpn = VPN::get()->count();

		return $ssh + $vpn;
	}

}
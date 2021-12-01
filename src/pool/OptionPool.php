<?php


namespace oiran\walletlib\pool;


use pocketmine\utils\Config;

class OptionPool
{
	private static Config $option;

	public static function init(Config $option) {
		self::$option = $option;
	}

	public static function getOption(): Config {
		return self::$option;
	}

	private function __construct() {}
}
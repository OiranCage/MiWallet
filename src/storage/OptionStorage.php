<?php


namespace oiran\storage;


use oiran\model\Option;

class OptionStorage
{
	private static Option $option;

	public static function init(Option $option) {
		self::$option = $option;
	}

	public static function getOption(): Option {
		return self::$option;
	}
}
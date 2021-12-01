<?php


namespace oiran\walletlib\utility;


class FolderPath
{
	public static string $path;

	public static function init(string $path) {
		self::$path = $path;
	}

	public static function get(): string {
		return self::$path;
	}
}
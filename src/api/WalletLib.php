<?php


namespace oiran\api;


use Exception;
use oiran\model\Option;
use oiran\storage\OptionStorage;

class WalletLib
{
	private static ?WalletLib $instance = null;

	public static function init(string $fileName, string $folderPath, int $warningLevel = WarningLevel::DO_NOT_PROCESS) {
		OptionStorage::init($option = new Option($warningLevel, $fileName.".json", $folderPath));
		if(!file_exists($option->getFullPath())) {
			file_put_contents($option->getFullPath(), "{}");
		}
	}

	/**
	 * @return WalletLib
	 * @throws Exception
	 */
	public static function getInstance(): WalletLib {
		return self::$instance ?? throw new Exception("library not initialized.");
	}

	private function __construct() {}
}
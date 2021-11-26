<?php


namespace oiran\walletlib\api;


use Exception;
use oiran\walletlib\model\Option;
use oiran\walletlib\storage\OptionStorage;
use oiran\walletlib\store\WalletStore;

class WalletLib
{
	private static ?WalletStore $store = null;

	public static function init(string $fileName, string $folderPath, int $warningLevel = WarningLevel::DO_NOT_PROCESS) {
		OptionStorage::init($option = new Option($warningLevel, $fileName.".json", $folderPath));
		if(!file_exists($option->getFullPath())) {
			file_put_contents($option->getFullPath(), "{}");
		}

		self::$store = new WalletStore();
	}

	/**
	 * @return WalletStore
	 * @throws Exception
	 */
	public static function store(): WalletStore {
		return self::$store ?? throw new Exception("Store not initialized.");
	}

	private function __construct() {}
}
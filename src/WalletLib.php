<?php


namespace oiran\walletlib;


use Exception;
use oiran\walletlib\model\Option;
use oiran\walletlib\repository\WalletRepository;
use oiran\walletlib\storage\OptionStorage;
use oiran\walletlib\store\WalletStore;
use oiran\walletlib\usecase\InputWalletDataUseCase;
use oiran\walletlib\usecase\OutputWalletDataUseCase;

class WalletLib
{
	private static ?WalletStore $store = null;
	private static ?WalletRepository $repository = null;

	public static function init(string $fileName, string $folderPath, int $warningLevel = WarningLevel::DO_NOT_PROCESS) {
		OptionStorage::init($option = new Option($warningLevel, $fileName.".json", $folderPath));
		if(!file_exists($option->getFullPath())) {
			file_put_contents($option->getFullPath(), "{}");
		}

		self::$store = new WalletStore();
		self::$repository = new WalletRepository(OutputWalletDataUseCase::execute());
	}

	public static function save(int $jsonFlag = JSON_PRETTY_PRINT) {
		InputWalletDataUseCase::execute($jsonFlag);
	}

	/**
	 * @return WalletStore
	 * @throws Exception
	 */
	public static function store(): WalletStore {
		return self::$store ?? throw new Exception("WalletStore not initialized.");
	}

	/**
	 * @return WalletRepository
	 * @throws Exception
	 */
	public static function repository(): WalletRepository {
		return self::$repository ?? throw new Exception("WalletRepository not initialized.");
	}

	private function __construct() {}
}
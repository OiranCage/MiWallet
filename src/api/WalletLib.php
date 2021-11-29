<?php


namespace oiran\walletlib\api;


use Exception;
use oiran\walletlib\model\Option;
use oiran\walletlib\repository\WalletRepository;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\store\WalletStore;
use oiran\walletlib\usecase\InputWalletDataUseCase;
use oiran\walletlib\usecase\OutputWalletDataUseCase;

class WalletLib
{
	private static ?WalletStore $store = null;
	private static ?WalletRepository $repository = null;

	public static function init(string $fileName, string $folderPath) {
		OptionPool::init($option = new Option($fileName.".json", $folderPath));
		if(!file_exists($option->getFullPath())) {
			file_put_contents($option->getFullPath(), json_encode([]));
		}

		self::join();
	}

	public static function join() {
		self::$store = new WalletStore();
		self::$repository = new WalletRepository();
	}

	public static function save(int $jsonFlag = JSON_PRETTY_PRINT) {
		InputWalletDataUseCase::execute($jsonFlag);
	}

	public static function store(): WalletStore {
		return self::$store /*?? throw new Exception("WalletStore not initialized.")*/;
	}

	public static function repository(): WalletRepository {
		return self::$repository /*?? throw new Exception("WalletRepository not initialized.")*/;
	}

	private function __construct() {}
}
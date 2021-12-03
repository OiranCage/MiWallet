<?php


namespace oiran\miwallet\api;


use oiran\miwallet\model\Wallet;
use oiran\miwallet\pocketmine\thread\SaveWalletThread;
use oiran\miwallet\pool\OptionPool;
use oiran\miwallet\pool\ThreadPool;
use oiran\miwallet\repository\WalletRepository;
use oiran\miwallet\store\WalletStore;
use oiran\miwallet\utility\FolderPath;

class WalletLib
{
	public static function findWallet(string $xuid): ?Wallet {
		$wallet = WalletStore::findBy($xuid);
		if ($wallet === null) {
			$wallet = WalletRepository::findBy($xuid);
			WalletStore::add($wallet);
		}

		return $wallet;
	}

	private function __construct() {}
}
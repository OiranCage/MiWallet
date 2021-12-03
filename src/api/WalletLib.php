<?php


namespace oiran\walletlib\api;


use oiran\walletlib\model\Wallet;
use oiran\walletlib\pocketmine\thread\SaveWalletThread;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\pool\ThreadPool;
use oiran\walletlib\repository\WalletRepository;
use oiran\walletlib\store\WalletStore;
use oiran\walletlib\utility\FolderPath;

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
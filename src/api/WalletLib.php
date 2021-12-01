<?php


namespace oiran\walletlib\api;


use oiran\walletlib\model\Wallet;
use oiran\walletlib\pocketmine\thread\SaveWalletThread;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\pool\ThreadPool;
use oiran\walletlib\store\WalletStore;
use oiran\walletlib\utility\FolderPath;

class WalletLib
{
	public static function save(Wallet $wallet) {
		if ($wallet->isChanged()) {
			$folder = OptionPool::getOption()->get("wallet_data_folder");
			$filePath = FolderPath::get().$folder.$wallet->getOwnerXuid().".json";
			ThreadPool::submit(new SaveWalletThread($wallet, $filePath));
		}
	}

	public static function findWallet(string $xuid): ?Wallet {
		return WalletStore::findBy($xuid);
	}

	private function __construct() {}
}
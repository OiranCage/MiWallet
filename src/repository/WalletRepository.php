<?php


namespace oiran\walletlib\repository;


use oiran\walletlib\dto\WalletDTO;
use oiran\walletlib\model\Wallet;
use oiran\walletlib\pocketmine\thread\SaveWalletThread;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\pool\ThreadPool;
use oiran\walletlib\utility\FolderPath;

class WalletRepository
{
	public static function findBy(string $xuid): ?Wallet {
		$folder = OptionPool::getOption()->get("wallet_data_folder");
		$filePath = FolderPath::get().$folder.$xuid.".json";

		return file_exists($filePath) ? WalletDTO::decode($xuid, json_decode(file_get_contents($filePath))) : null;
	}

	public static function write(Wallet $wallet) {
		if ($wallet->isChanged()) {
			$folder = OptionPool::getOption()->get("wallet_data_folder");
			$filePath = FolderPath::get().$folder.$wallet->getOwnerXuid().".json";
			ThreadPool::submit(new SaveWalletThread($wallet, $filePath));
		}
	}
}
<?php


namespace oiran\miwallet\repository;


use oiran\miwallet\dto\WalletDTO;
use oiran\miwallet\model\Wallet;
use oiran\miwallet\pocketmine\thread\SaveWalletThread;
use oiran\miwallet\pool\OptionPool;
use oiran\miwallet\pool\ThreadPool;
use oiran\miwallet\utility\FolderPath;

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
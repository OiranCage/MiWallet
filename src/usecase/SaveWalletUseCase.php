<?php


namespace oiran\walletlib\usecase;


use oiran\walletlib\model\Wallet;
use oiran\walletlib\pocketmine\thread\SaveWalletThread;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\pool\ThreadPool;
use oiran\walletlib\utility\FolderPath;

class SaveWalletUseCase
{
	public static function execute(Wallet $wallet) {
		if ($wallet->isChanged()) {
			$folder = OptionPool::getOption()->get("wallet_data_folder");
			$filePath = FolderPath::get().$folder.$wallet->getOwnerXuid().".json";
			ThreadPool::submit(new SaveWalletThread($wallet, $filePath));
		}
	}
}
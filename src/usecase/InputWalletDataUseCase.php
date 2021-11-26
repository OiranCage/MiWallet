<?php


namespace oiran\walletlib\usecase;


use oiran\walletlib\api\WalletLib;
use oiran\walletlib\dto\WalletDTO;
use oiran\walletlib\storage\OptionStorage;

class InputWalletDataUseCase
{
	public static function execute(int $jsonFlag) {
		$walletMap = WalletLib::repository()->getDecodeWalletMap();
		foreach (WalletLib::store() as $wallet) {
			$walletMap[$wallet->getOwnerXuid()] = WalletDTO::encode($wallet);
			// WalletLib::store()->delete($wallet->getOwnerXuid());
		}

		$jsonData = json_encode($walletMap, $jsonFlag);
		file_put_contents(OptionStorage::getOption()->getFullPath(), $jsonData);

		WalletLib::join();
	}
}
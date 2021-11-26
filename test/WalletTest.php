<?php


namespace test;


use oiran\walletlib\api\WalletLib;
use oiran\walletlib\model\Wallet;

class WalletTest
{
	public static function execute() {
		WalletLib::init("test", "C:\Users\admin\Desktop\\");
		echo "Init Success.".PHP_EOL;

		$wallet = new Wallet("test12345", "tester", 500);
		WalletLib::store()->add($wallet);
		echo "Wallet added.".PHP_EOL;

		var_dump(WalletLib::store()->findBy("test12345"));

		var_dump(WalletLib::repository()->getDecodeWalletMap());

		WalletLib::save();

		var_dump(WalletLib::repository()->getDecodeWalletMap());
	}
}
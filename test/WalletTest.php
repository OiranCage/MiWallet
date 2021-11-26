<?php


namespace test;


use oiran\walletlib\api\WalletLib;
use oiran\walletlib\api\WarningLevel;
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


		$wallet = new Wallet("test", "test", 0);
		$result = $wallet->earnCoin(PHP_INT_MAX + 1);
		echo "earn result: $result";

		$wallet = new Wallet("test", "test", 0);
		$result = $wallet->spendCoin(100);
		echo "earn result: $result";


		WalletLib::init("test", "C:\Users\admin\Desktop\\", WarningLevel::NONE);
		echo "Init Success.".PHP_EOL;

		$wallet = new Wallet("test", "test", 0);
		$wallet->earnCoin(PHP_INT_MAX + 1);
		echo $wallet->getMoney();

		$wallet = new Wallet("test", "test", 0);
		$wallet->spendCoin(100);
		echo $wallet->getMoney();


		WalletLib::init("test", "C:\Users\admin\Desktop\\", WarningLevel::THROW_EXCEPTION);
		echo "Init Success.".PHP_EOL;

		$wallet->earnCoin(PHP_INT_MAX + 1);
	}
}
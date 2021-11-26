<?php


namespace test;


use oiran\walletlib\api\WalletLib;
use oiran\walletlib\api\WarningLevel;
use oiran\walletlib\model\Wallet;
use PHPUnit\Framework\TestCase;

class WalletTest extends TestCase
{
	public function testExecute() {
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
		$result = $wallet->spendCoin(100);
		echo $result .PHP_EOL;


		WalletLib::init("test", "C:\Users\admin\Desktop\\", WarningLevel::NONE);
		echo "Init Success.".PHP_EOL;

		$wallet = new Wallet("test", "test", 0);
		$wallet->spendCoin(100);
		echo $wallet->getMoney().PHP_EOL;


		WalletLib::init("test", "C:\Users\admin\Desktop\\", WarningLevel::THROW_EXCEPTION);
		echo "Init Success.".PHP_EOL;

		// $wallet->spendCoin(-1);

		$this->assertSame(0, 1); // ?
	}
}
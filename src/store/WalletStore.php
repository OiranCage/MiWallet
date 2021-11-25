<?php


namespace oiran\walletlib\store;


use oiran\walletlib\model\Wallet;

class WalletStore
{
	public static array $walletMap = [];

	public static function add(Wallet $wallet) {
		self::$walletMap[$wallet->getOwnerXuid()] = $wallet;
	}

	public static function delete(string $xuid) {
		unset(self::$walletMap[$xuid]);
	}

	public static function findBy(string $xuid): ?Wallet {
		return self::$walletMap[$xuid] ?? null;
	}
}
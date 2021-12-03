<?php


namespace oiran\miwallet\store;


use oiran\miwallet\model\Wallet;

class WalletStore
{
	private static array $walletMap = [];

	public static function add(Wallet $wallet) {
		self::$walletMap[$wallet->getOwnerXuid()] = $wallet;
	}

	public static function delete(string $xuid) {
		unset(self::$walletMap[$xuid]);
	}

	public static function findBy(string $xuid): ?Wallet {
		return self::$walletMap[$xuid] ?? null;
	}

	public static function getWalletMap(): array {
		return self::$walletMap;
	}

	private function __construct() {}
}
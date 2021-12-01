<?php


namespace oiran\walletlib\dto;


use oiran\walletlib\model\Wallet;

class WalletDTO
{
	public static function decode(string $xuid, array $data): Wallet {
		return new Wallet($xuid, $data["ownerName"], $data["moneyAmount"]);
	}

	public static function encode(Wallet $wallet): string {
		return json_encode([
			"moneyAmount" => $wallet->getMoney(),
			"ownerName" => $wallet->getOwnerName()
		], JSON_PRETTY_PRINT);
	}
}
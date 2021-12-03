<?php


namespace oiran\walletlib\pocketmine\event;


use oiran\walletlib\model\Wallet;
use pocketmine\event\Event;

class WalletCreateEvent extends Event
{
	public function __construct(
		private Wallet $wallet
	) {}

	public function getWallet(): Wallet {
		return $this->wallet;
	}
}
<?php


namespace oiran\miwallet\pocketmine\event;


use oiran\miwallet\model\Wallet;
use pocketmine\event\Event;

class PayMoneyEvent extends Event
{
	public function __construct(
		private Wallet $to,
		private Wallet $from
	) {}

	public function getTo(): Wallet {
		return $this->to;
	}

	public function getFrom(): Wallet {
		return $this->from;
	}
}
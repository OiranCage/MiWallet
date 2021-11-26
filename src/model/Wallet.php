<?php


namespace oiran\walletlib\model;


class Wallet
{
	public function __construct(
		private string $ownerXuid,
		private string $ownerName,
		private int $moneyAmount
	) {}

	public function getMoney(): int {
		return $this->moneyAmount;
	}

	public function getOwnerXuid(): string {
		return $this->ownerXuid;
	}

	public function getOwnerName(): string {
		return $this->ownerName;
	}
}
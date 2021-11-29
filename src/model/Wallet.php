<?php


namespace oiran\walletlib\model;


class Wallet
{
	public function __construct(
		private string $ownerXuid,
		private string $ownerName,
		private Money $money
	) {}

	public function earn(int $amount) {
		$this->money = $this->money->add(new Money($amount));
	}

	public function spend(int $amount) {
		$this->money = $this->money->sub(new Money($amount));
	}

	public function getMoney(): Money {
		return $this->money;
	}

	public function getOwnerXuid(): string {
		return $this->ownerXuid;
	}

	public function getOwnerName(): string {
		return $this->ownerName;
	}
}
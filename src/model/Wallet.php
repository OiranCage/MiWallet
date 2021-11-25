<?php


namespace oiran\model;


class Wallet
{
	public function __construct(
		private int $moneyAmount,
		private string $ownerXuid,
		private string $ownerName
	) {}

	public function getOwnerXuid(): string {
		return $this->ownerXuid;
	}

	public function getOwnerName(): string {
		return $this->ownerName;
	}
}
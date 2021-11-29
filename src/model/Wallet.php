<?php


namespace oiran\walletlib\model;


use Exception;
use oiran\walletlib\api\WarningLevel;
use oiran\walletlib\pool\OptionPool;

class Wallet
{
	public function __construct(
		private string $ownerXuid,
		private string $ownerName,
		private int $moneyAmount
	) {}

	public function earnCoin(int $value): bool {
		$result = $this->moneyAmount + $value;
		if(PHP_INT_MAX < $result) {
		}

		$this->moneyAmount = $result;
		return true;
	}

	public function spendCoin(int $value): bool {
		$result = $this->moneyAmount - $value;
		if($this->moneyAmount < 0) {
		}

		$this->moneyAmount = $result;
		return true;
	}

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
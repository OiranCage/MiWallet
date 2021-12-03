<?php


namespace oiran\walletlib\model;


use oiran\walletlib\pocketmine\event\PayMoneyEvent;

class Wallet
{
	public function __construct(
		private string $ownerXuid,
		private string $ownerName,
		private Money $money,
		private bool $changed = false
	) {}

	public function earn(int $amount) {
		$this->changed = true;
		$this->money = $this->money->add(new Money($amount));
	}

	public function spend(int $amount) {
		$this->changed = true;
		$this->money = $this->money->sub(new Money($amount));
	}

	public function payTo(Wallet $wallet, int $amount) {
		if ($amount < $this->money->getAmount()) {
			$wallet->earn($amount);
			$this->spend($amount);

			$event = new PayMoneyEvent($this, $wallet);
			$event->call();
		}
	}

	public function isChanged(): bool {
		return $this->changed;
	}

	public function initChangeFlag() {
		$this->changed = false;
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

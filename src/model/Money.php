<?php


namespace oiran\miwallet\model;


class Money
{
	public function __construct(
		private int $amount
	) {}

	public function add(Money $money): Money {
		if(PHP_INT_MAX - $this->amount < $money->getAmount()) {
			return new Money(PHP_INT_MAX);
		} else {
			return new Money($this->amount + $money->getAmount());
		}
	}

	public function sub(Money $money): Money {
		if($this->amount - $money->getAmount() < 0) {
			return new Money(0);
		} else {
			return new Money($money->getAmount() - $this->amount);
		}
	}

	public function getAmount(): int {
		return $this->amount;
	}
}
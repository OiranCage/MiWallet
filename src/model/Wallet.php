<?php


declare(strict_types=1);


namespace oiran;

class Wallet
{
	public function __construct(
		private int $moneyAmount,
		private string $ownerXuid,
		private string $ownerName
	) {}
}
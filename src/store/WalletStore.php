<?php


namespace oiran\walletlib\store;


use oiran\walletlib\model\Wallet;

class WalletStore
{
	public function __construct(
		private array $walletMap = []
	) {}

	public function add(Wallet $wallet) {
		$this->walletMap[$wallet->getOwnerXuid()] = $wallet;
	}

	public function delete(string $xuid) {
		unset($this->walletMap[$xuid]);
	}

	public function findBy(string $xuid): ?Wallet {
		return $this->walletMap[$xuid] ?? null;
	}

	public function getWalletMap(): array {
		return $this->walletMap;
	}
}
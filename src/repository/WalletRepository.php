<?php


namespace oiran\walletlib\repository;


use oiran\walletlib\dto\WalletDTO;
use oiran\walletlib\model\Wallet;

class WalletRepository
{
	public function __construct(
		public array $decodeWalletMap
	) {}

	public function push(Wallet $wallet) {
		$this->decodeWalletMap[$wallet->getOwnerXuid()] = $wallet;
	}

	public function delete(string $xuid) {
		unset($this->decodeWalletMap[$xuid]);
	}

	public function findBy(string $xuid): ?Wallet {
		$data = $this->decodeWalletMap[$xuid];
		return $data === null ? null : WalletDTO::decode($xuid, $data);
	}

	public function getDecodeWalletMap(): array {
		return $this->decodeWalletMap;
	}
}
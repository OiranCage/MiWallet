<?php


namespace oiran\walletlib\pocketmine\thread;


use oiran\walletlib\dto\WalletDTO;
use oiran\walletlib\model\Wallet;
use pocketmine\scheduler\AsyncTask;

class SaveWalletThread extends AsyncTask
{
	private string $xuid;
	private string $jsonData;

	public function __construct(Wallet $wallet, private string $path) {
		$this->xuid = $wallet->getOwnerXuid();
		$this->jsonData = WalletDTO::encode($wallet);
	}

	public function onRun(): void {
		file_put_contents($this->path, $this->jsonData);
	}
}
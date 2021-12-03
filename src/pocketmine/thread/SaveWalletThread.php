<?php


namespace oiran\miwallet\pocketmine\thread;


use oiran\miwallet\dto\WalletDTO;
use oiran\miwallet\model\Wallet;
use oiran\miwallet\store\WalletStore;
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

	public function onCompletion(): void {
		WalletStore::findBy($this->xuid)?->initChangeFlag();
	}
}

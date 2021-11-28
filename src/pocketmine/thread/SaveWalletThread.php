<?php


namespace oiran\walletlib\pocketmine\thread;


use pocketmine\scheduler\AsyncTask;

class SaveWalletThread extends AsyncTask
{
	private bool $login = false;

	public function __construct(
		private string $path,
		private string $jsonData,
		private string $xuid
	) {}

	public function onRun(): void {
		file_put_contents($this->path, $this->jsonData);
	}

	public function onCompletion(): void {
		if($this->login) {
			// TODO; add Wallet to Store
		}
	}
}
<?php


namespace oiran\walletlib\pocketmine\thread;


use pocketmine\scheduler\AsyncTask;

class SaveWalletThread extends AsyncTask
{
	public function __construct(
		private string $path,
		private string $jsonData
	) {}

	public function onRun(): void {
		file_put_contents($this->path, $this->jsonData);
	}
}
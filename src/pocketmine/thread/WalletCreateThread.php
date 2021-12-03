<?php


namespace oiran\miwallet\pocketmine\thread;


use oiran\miwallet\dto\WalletDTO;
use oiran\miwallet\model\Money;
use oiran\miwallet\model\Wallet;
use oiran\miwallet\pocketmine\event\WalletCreateEvent;
use oiran\miwallet\pool\OptionPool;
use oiran\miwallet\store\WalletStore;
use oiran\miwallet\utility\FolderPath;
use pocketmine\scheduler\AsyncTask;

class WalletCreateThread extends AsyncTask
{
	private string $filePath;

	public function __construct(
		private string $xuid,
		private string $name,
		private int $defaultMoney
	) {
		$folder = OptionPool::getOption()->get("wallet_data_folder");
		$this->filePath = FolderPath::get().$folder.$xuid.".json";
	}

	public function onRun(): void {
		$this->setResult(file_exists($this->filePath)
			? json_decode(file_get_contents($this->filePath), true) : null
		);
	}

	public function onCompletion(): void {
		$result = $this->getResult();
		WalletStore::add($wallet = $result === null
			? new Wallet($this->xuid, $this->name, new Money($this->defaultMoney), true)
			: WalletDTO::decode($this->xuid, $result)
		);

		$event = new WalletCreateEvent($wallet);
		$event->call();
	}
}
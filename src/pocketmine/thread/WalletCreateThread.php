<?php


namespace oiran\walletlib\pocketmine\thread;


use oiran\walletlib\dto\WalletDTO;
use oiran\walletlib\model\Money;
use oiran\walletlib\model\Wallet;
use oiran\walletlib\pocketmine\event\WalletCreateEvent;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\store\WalletStore;
use oiran\walletlib\utility\FolderPath;
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
<?php


namespace oiran\miwallet;


use oiran\miwallet\pocketmine\EventListener;
use oiran\miwallet\pool\OptionPool;
use oiran\miwallet\pool\ThreadPool;
use oiran\miwallet\repository\WalletRepository;
use oiran\miwallet\store\WalletStore;
use oiran\miwallet\utility\FolderPath;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\AsyncPool;
use pocketmine\utils\Config;

class Main extends PluginBase
{
	protected function onEnable(): void {
		FolderPath::init($this->getDataFolder());

		OptionPool::init($option = new Config($this->getDataFolder()."option.json", Config::JSON, [
			"default_money" => 0,
			"wallet_data_folder" => "player".DIRECTORY_SEPARATOR,
			"pool_size" => 2,
			"worker_memory_limit" => 256,
			"async_create_wallet" => false
		]));

		ThreadPool::init(new AsyncPool(
			$option->get("pool_size"),
			$option->get("worker_memory_limit"),
			$this->getServer()->getLoader(),
			$this->getServer()->getLogger(),
			$this->getServer()->getTickSleeper()
		));

		@mkdir($this->getDataFolder().$option->get("wallet_data_folder"));

		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}

	protected function onDisable(): void {
		foreach (WalletStore::getWalletMap() as $wallet) {
			WalletRepository::write($wallet);
		}
	}
}
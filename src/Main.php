<?php


namespace oiran\walletlib;


use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\pool\ThreadPool;
use oiran\walletlib\repository\WalletRepository;
use oiran\walletlib\store\WalletStore;
use oiran\walletlib\utility\FolderPath;
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
	}

	protected function onDisable(): void {
		foreach (WalletStore::getWalletMap() as $wallet) {
			WalletRepository::write($wallet);
		}
	}
}
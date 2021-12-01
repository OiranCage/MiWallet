<?php


namespace oiran\walletlib;


use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\pool\ThreadPool;
use oiran\walletlib\store\WalletStore;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\AsyncPool;
use pocketmine\utils\Config;

class Main extends PluginBase
{
	protected function onEnable(): void {
		OptionPool::init($option = new Config($this->getDataFolder()."option.json", Config::JSON, [
			"default_money" => 0,
			"wallet_data_folder" => "player".DIRECTORY_SEPARATOR,
			"pool_size" => 2,
			"worker_memory_limit" => 256
		]));

		ThreadPool::init(new AsyncPool(
			$option->get("pool_size"),
			$option->get("worker_memory_limit"),
			$this->getServer()->getLoader(),
			$this->getServer()->getLogger(),
			$this->getServer()->getTickSleeper()
		));
	}

	protected function onDisable(): void {
		$walletDataFolder = OptionPool::getOption()->get("wallet_data_folder");
		$filePathPrefix = $this->getDataFolder().$walletDataFolder;
		foreach (WalletStore::getWalletMap() as $wallet) {
			if ($wallet->isChanged()) {
				file_put_contents(
					$filePathPrefix.$wallet->getOwnerXuid().".json",
					json_encode([
						"ownerName" => $wallet->getOwnerName(),
						"moneyAmount" => $wallet->getMoney()->getAmount()
					])
				);
			}
		}
	}
}
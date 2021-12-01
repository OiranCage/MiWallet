<?php


namespace oiran\walletlib;


use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\store\WalletStore;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase
{
	protected function onEnable(): void {
		OptionPool::init(new Config($this->getDataFolder()."option.json", Config::JSON, [
			"default_money" => 0,
			"wallet_data_folder" => "player".DIRECTORY_SEPARATOR
		]));
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
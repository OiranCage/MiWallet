<?php


namespace oiran\walletlib\pocketmine;


use oiran\walletlib\api\WalletLib;
use oiran\walletlib\dto\WalletDTO;
use oiran\walletlib\model\Wallet;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\store\WalletStore;
use oiran\walletlib\utility\FolderPath;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener
{
	public function onPlayerJoinEvent(PlayerJoinEvent $event) {
		$name = $event->getPlayer()->getName();
		$xuid = $event->getPlayer()->getXuid();
		$folder = OptionPool::getOption()->get("wallet_data_folder");
		$filePath = FolderPath::get().$folder.$xuid.".json";

		$wallet = file_exists($filePath)
			? WalletDTO::decode($xuid, json_decode(file_get_contents($filePath)))
			: new Wallet($xuid, $name, OptionPool::getOption()->get("default_money"));
		WalletStore::add($wallet);
	}

	public function onPlayerQuitEvent(PlayerQuitEvent $event) {
		WalletLib::save(WalletStore::findBy($event->getPlayer()->getXuid()));
	}
}
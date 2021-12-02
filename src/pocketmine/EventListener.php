<?php


namespace oiran\walletlib\pocketmine;


use oiran\walletlib\model\Wallet;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\repository\WalletRepository;
use oiran\walletlib\store\WalletStore;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener
{
	public function onPlayerJoinEvent(PlayerJoinEvent $event) {
		$xuid = $event->getPlayer()->getXuid();
		$wallet = WalletRepository::findBy($xuid);
		if ($wallet === null) {
			$wallet = new Wallet($xuid, $event->getPlayer()->getName(), OptionPool::getOption()->get("default_money"));
		}

		WalletStore::add($wallet);
	}

	public function onPlayerQuitEvent(PlayerQuitEvent $event) {
		WalletRepository::write(WalletStore::findBy($event->getPlayer()->getXuid()));
	}
}
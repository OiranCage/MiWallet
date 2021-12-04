<?php


namespace oiran\miwallet\pocketmine;


use oiran\miwallet\model\Money;
use oiran\miwallet\model\Wallet;
use oiran\miwallet\pocketmine\event\WalletCreateEvent;
use oiran\miwallet\pocketmine\thread\WalletCreateThread;
use oiran\miwallet\pool\OptionPool;
use oiran\miwallet\pool\ThreadPool;
use oiran\miwallet\repository\WalletRepository;
use oiran\miwallet\store\WalletStore;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener
{
	public function onPlayerJoinEvent(PlayerJoinEvent $event) {
		$name = $event->getPlayer()->getName();
		$xuid = $event->getPlayer()->getXuid();
		$defaultMoney = OptionPool::getOption()->get("default_money");

		if (OptionPool::getOption()->get("async_create_wallet")) {
			ThreadPool::submit(new WalletCreateThread($xuid, $name, $defaultMoney));
		} else {
			$wallet = WalletRepository::findBy($xuid);
			if ($wallet === null) {
				$wallet = new Wallet($xuid, $name, new Money($defaultMoney), true);
			}

			WalletStore::add($wallet);

			$event = new WalletCreateEvent($wallet);
			$event->call();
		}
	}

	public function onPlayerQuitEvent(PlayerQuitEvent $event) {
		WalletRepository::write(WalletStore::findBy($event->getPlayer()->getXuid()));
		WalletStore::delete($event->getPlayer()->getXuid());
	}
}
<?php


namespace oiran\walletlib\pocketmine;


use oiran\walletlib\model\Money;
use oiran\walletlib\model\Wallet;
use oiran\walletlib\pocketmine\event\WalletCreateEvent;
use oiran\walletlib\pocketmine\thread\CreateWalletThread;
use oiran\walletlib\pool\OptionPool;
use oiran\walletlib\pool\ThreadPool;
use oiran\walletlib\repository\WalletRepository;
use oiran\walletlib\store\WalletStore;
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
			ThreadPool::submit(new CreateWalletThread($xuid, $name, $defaultMoney));
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
	}
}
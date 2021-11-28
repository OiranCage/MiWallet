<?php


namespace oiran\walletlib\pocketmine;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener
{
	public function onPlayerJoinEvent(PlayerJoinEvent $event) {
		// TODO; add to Player Wallet to Store
	}

	public function onPlayerQuitEvent(PlayerQuitEvent $event) {
		// TODO; save Player Wallet of Store
	}
}
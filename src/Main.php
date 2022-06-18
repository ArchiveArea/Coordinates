<?php

declare(strict_types=1);

namespace NhanAZ\Coordinates;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;

class Main extends PluginBase implements Listener {

	private bool $value = true;
	private bool $isPlayerModifiable = false;

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $event): void {
		$player = $event->getPlayer();
		$packet = new GameRulesChangedPacket();
		$packet->gameRules = [
			"ShowCoordinates" => new BoolGameRule($this->value, $this->isPlayerModifiable)
		];
		$player->getNetworkSession()->sendDataPacket($packet);
	}
}

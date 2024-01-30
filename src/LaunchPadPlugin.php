<?php

namespace LaunchPad;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\PressurePlateActivateEvent;
use pocketmine\math\Vector3;

class LaunchPadPlugin extends PluginBase implements Listener {

    public function onEnable() {
        $this->getLogger()->info("LaunchPadPlugin has been enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPressurePlateActivate(PressurePlateActivateEvent $event) {
        $block = $event->getBlock();
        $player = $event->getPlayer();

        // Check if the pressure plate is made of wood
        if ($block->getId() === 72) {
            // Launch the player forward by 10 blocks
            $this->launchPlayer($player, 10);
        }
    }

    public function launchPlayer($player, $distance) {
        // Get the player's current position
        $pos = $player->getPosition();

        // Calculate the new position after launching
        $direction = $player->getDirectionVector()->normalize()->multiply($distance);
        $newPos = $pos->add($direction);

        // Set the player's new position
        $player->teleport($newPos);
    }
}

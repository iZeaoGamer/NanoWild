<?php


namespace ItsGabry\NanoWild;


use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\scheduler\Task;

class NanoWildTask extends Task {


    private $sender;
    private $position;

    public function __construct(Player $sender, Position $position) {
        $this->sender = $sender;
        $this->position = $position;
    }

    public function onRun($currentTick) {
        if ($this->sender->isOnline()) {
            $this->sender->teleport($this->sender->getLevel()->getSafeSpawn($this->position));
        }
    }
}
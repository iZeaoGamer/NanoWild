<?php

namespace ItsGabry\NanoWild;



use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class TitleTask extends Task {

    private $sender;
    private $countdown;
    private $plugin;


    public function __construct(Player $sender, Plugin $plugin) {
        $this->sender = $sender;
        $this->countdown = 10;
        $this->plugin = $plugin;

    }
    public function onRun($currentTick) {
        if ($this->sender->isOnline()) {
            $this->countdown = $this->countdown - 1;
            if ($this->countdown !== 0) {
                $this->sender->sendMessage(TextFormat::GREEN . $this->countdown . " " . "seconds left");
            } else {
                $this->sender->sendMessage(TextFormat::GREEN . "You will be teleported!");
            }
            if ($this->countdown === 0) {
                $this->plugin->getScheduler()->cancelTask($this->getTaskId());
            }
        }
    }
}
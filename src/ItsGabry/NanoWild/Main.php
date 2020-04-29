<?php

namespace ItsGabry\NanoWild;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;


class Main extends PluginBase implements Listener {
    public function onEnable() {
       $this->getServer()->getPluginManager()->registerEvents($this, $this);
       $this->saveDefaultConfig();
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch ($command->getName()) {
            case "wild":
                if($sender instanceof Player) {
                        $range = $this->getConfig()->get("range");
                        $x = rand(-$range, $range);
                        $z = rand(-$range, $range);
                        $y = 256;
                        $sender->getLevel()->populateChunk($x >> 4, $z >> 4, true);
                        $sender->sendMessage(TextFormat::GREEN . "Wait 10 seconds...");
                        $this->getScheduler()->scheduleDelayedTask(new NanoWildTask($sender, new Position($x, $y, $z, $this->getServer()->getLevelByName("wild"))), 200);
                        $this->getScheduler()->scheduleRepeatingTask(new TitleTask($sender, $this), 20);
                }
        }
      return true;
    }
}

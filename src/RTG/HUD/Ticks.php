<?php

namespace RTG\HUD;

use pocketmine\scheduler\PluginTask;
use pocketmine\Plugin;
use pocketmine\Server;
use pocketmine\Player;

class Ticks extends PluginTask {
	
	const COUNT = 0;
	
	public function __construct($plugin) {
        $this->plugin = $plugin;
        parent::__construct($plugin);
        $this->count = Task::COUNT;
            
    }
	
	public function onRun($currentTick) {
		foreach($this->getServer()->getOnlinePlayers() as $p) {
			if($this->plugin->isOn($p) === true) {
				$msg = $this->plugin->getMsg($this->count, $p);
				$p->sendPopup($msg);
				$this->count++;
			}
		}
	}
}
<?php

namespace RTG\HUD;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\Config;

class Loader extends PluginBase implements Listener {
	
	public function onEnable() {
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		
		$this->enabled = array();
		
		$this->cfg = new Config($this->getDataFolder() . "config.yml");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, array $param) {
		switch(strtolower($param[0])) {
			
			case "myhud":
				if($sender->hasPermission("myhud.toggle") or $sender->isOp()) {
					
					if(!(isset($this->enabled[strtolower($p->getName())]))) {
						$this->enabled[strtolower($p->getName())] = strtolower($p->getName());
						$sender->sendMessage("You have turned on MyHUD!");
					}
					else if(isset($this->enabled[strtolower($p->getName())])) {
							unset($this->enabled[strtolower($p->getName())]);
							$sender->sendMessage("You have turned off MyHUD!");
					}
					
				}
				else {
					$sender->sendMessage(TF::RED . "You have no permission to use this command!");
				}
				return true;
			break;
		
		}
	}
	
	public function isOn(Player $p) {
		if(isset($this->enabled[strtolower($p->getName())])) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function getMsg(Player $p) {
		$m = $this->cfg->get("Messages");
		return $this->formatMessage($m[$current], $p);
	}
	
	public function onDisable() {
	}
	
}
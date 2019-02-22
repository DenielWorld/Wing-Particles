<?php

namespace Wings;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use Wings\Tasks\{DevilWing, AngleWing};
use pocketmine\Player;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase{

	public $taskwingdevil;
	public $taskwingthienthan;
	public $wingdevil = [];
	public $wingthienthan = [];

	/** @var Config */
	public $config;
	public $checker;

	public function onEnable () : void{
		$this->taskwingdevil = new DevilWing($this);
		$this->taskwingthienthan = new AngleWing($this);
		$this->getServer()->getLogger()->info("§b         
| |  | (_)            
| |  | |_ _ __   __ _ 
| |/\| | | '_ \ / _` |
\  /\  / | | | | (_| |
 \/  \/|_|_| |_|\__, |
                 __/ |
                |___/ 
§aMake by MrDinDuck and RushToEasy[Wing modules]");
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		if ($cmd == "wing"){
			if(!$sender instanceof Player){
				$sender->sendMessage("§l§9Wings§e>§r§c Ingame only!");
				return true;
			}
			$form = new SimpleForm(function (Player $player, ?int $data) {
				if(!is_null($data)) {
					switch($data) {
						case 0:
							if(!$player->hasPermission("devil.wing")){
								$player->sendMessage("§l§9Wings§e>§r§c No permission!");
								return true;
							}
							$name = $player->getName();
								if(in_array($name, $this->wingthienthan)) {
									unset($this->wingthienthan[array_search($name, $this->wingthienthan)]);
									$player->sendMessage("§l§9Wings§e>§r§a Enable §4Devil Wing");
									$this->wingdevil[] = $name;
								}
									if(!in_array($name, $this->wingdevil)){
										$this->wingdevil[] = $name;
										$player->sendMessage("§l§9Wings§e>§r§a Enable §4Devil Wing");
									}
									break;
						case 1:
							if(!$player->hasPermission("thienthan.wing")){
								$player->sendMessage("§l§9Wings§e>§r§c No permission!");
								return true;
							}
							$name = $player->getName();
								if(in_array($name, $this->wingdevil)) {
									unset($this->wingdevil[array_search($name, $this->wingdevil)]);
									$player->sendMessage("§l§9Wings§e>§r§a Enable §bAngle Wing");
									$this->wingthienthan[] = $name;
								}
									if(!in_array($name, $this->wingthienthan)){
										$this->wingthienthan[] = $name;
										$player->sendMessage("§l§9Wings§e>§r§a Enable §bAngle Wing");
									}
									break;
						case 2:
						$name = $player->getName();
							if(in_array($name, $this->wingdevil)){
								unset($this->wingdevil[array_search($name, $this->wingdevil)]);
								$player->sendMessage("§l§9Wings§e>§r§c Disable §4Devil Wing");
								}elseif(in_array($name, $this->wingthienthan)){
								unset($this->wingthienthan[array_search($name, $this->wingthienthan)]);
								$player->sendMessage("§l§9Wings§e>§r§c Disable §bAngle Wing");
								}
								break;
								case 3:
								break;
								}
					}
				});
			$form->setTitle("§b§l❄§9Wings Menu§b❄");
			$form->setContent("§aCác wings của máy chủ :3");
			$form->addButton("§4§lDevil");
			$form->addButton("§b§lAngle");
			$form->addButton("§c§lTắt cánh");
			$form->addButton("§cExit");
            $sender->sendForm($form);
		return true;
		}
	}
}

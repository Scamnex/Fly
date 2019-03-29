<?php
/**
 *(C) Copyright by ChampNinjas
 */

namespace Fly;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
	
     public function onEnable(){
         $this->getLogger()->info("Plugin ist aktiviert");
         $this->saveResource("messages.yml");	}

     public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool;
         if(!$sender instanceof Player){
           $sender->sendMessage("Benutze den Command InGame!");
           return false;
         }

           switch("$command->getName()){
	   case "fly";
           if(!$sender->hasPermission("fly.use")){
             if(!$sender->isCreative()){
               $sender->setAllowFlight(true);
               $sender->setFlying(true);
               $sender->sendMessage($flyon);
             }else{
               $sender->setAllowFlight(false);
               $sender->setFlying(false);
               $sender->sendMessage($flyoff);
             }
             $settings = new Config($this->getDataFolder() . "messages.yml", Config::YAML); 
             $flyon = $settings->get("fly_on"); 
             $flyoff = $settings->get("fly_off");
             $no_perm = $settings->get("no_perm");
             $pvpfly = $settings->get("pvp_fly");
           }else{
             $sender->sendMessage($no_perm);
             return false;
           }
        }
        return true;
	
    }
  }
}

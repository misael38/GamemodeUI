<?php

namespace GamemodeUI;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as lol;

use jojoe77777\FormAPI;

Class Main extends PluginBase{
  
  public function onEnable(){
    $this->getLogger()->info("§aEnable §bGamemodeUI...");
      $this->saveDefaultConfig();
# Remember to use make a reasource and make config.yml
# with survival-title "???"
# etc.If you want you can modify this code

  }
  
  public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
    if($command->getName() === "gmui"){
      if($sender->hasPermission("gmui.cmd")){
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createCustomForm(function(Player $sender, $data){
          $result = $data[0];
          if( !is_null($data)) {
            switch($result) {
            case 0:
              break;
            case 1:
              $sender->sendMessage($this->getConfig()->get("msg-creative"));
              $sender->addTitle($this->getConfig()->get("creative-title"));
              $sender->setGamemode(1);
              break;
            case 2:
              $sender->sendMessage($this->getConfig()->get("msg-survival"));
              $sender->addTitle($this->getConfig()->get("survival-title"));
  }
              $sender->setGamemode(0);
              break;
            case 3:
              $sender->sendMessage($this->getConfig()->get("msg-adventure"));
              $sender->addTitle($this->getConfig()->get("adventure-title"));
              $sender->setGamemode(2);
              break;
            case 4:
              $sender->sendMessage($this->getConfig()->get("msg-spectator"));
              $sender->addTitle($this->getConfig()->get("spectator-title"));
              $sender->setGamemode(3);
              default:
                return;
                }
           }
          });
          $form->setTitle($this->getConfig()->get("Title"));
          $form->addDropdown("Menu", ["Exit", "Creative", "Survival", "Adventure", "Spectator"]);
          $form->sendToPlayer($sender);
      } else {
        $sender->sendMessage($this->getConfig()->get("msg-no-perm"));
      }
    }
    return true;
  }
}

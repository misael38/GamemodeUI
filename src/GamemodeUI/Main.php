<?php

namespace GamemodeUI;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;

Class Main extends PluginBase{
  
  public function onEnable(){
    $this->getLogger()->info("§aEnable §bGamemodeUI..");
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
              $sender->sendMessage("§aChange gamemode to gamemode Creative");
              $sender->addTitle("§eCreative mode", "§fCreative mode is enable");
              $sender->setGamemode(1);
              break;
            case 2:
              $sender->sendMessage("§aChange gamemode to gamemode Survival");
              $sender->addTitle("§eSurvival mode", "§fSurvival mode is enable");
              $sender->setGamemode(0);
              break;
            case 3:
              $sender->sendMessage("§aChange gamemode to gamemode Adventure");
              $sender->addTitle("§eAdventure mode", "§fAdventure mode is enable");
              $sender->setGamemode(2);
              break;
            case 4:
              $sender->sendMessage("§aChange gamemode to gamemode Spectator");
              $sender->addTitle("§eSpector mode", "§fSpector mode is enable");
              $sender->setGamemode(3);
              default:
                return;
                }
           }
          });
          $form->setTitle("§7§lGamemodeUI");
          $form->addDropdown("Menu", ["Exit", "Creative", "Survival", "Adventure", "Spectator"]);
          $form->sendToPlayer($sender);
      } else {
        $sender->sendMessage("§cYou did not operater or you don't have permission!");
      }
    }
    return true;
  }
}

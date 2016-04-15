<?php

namespace ImSilencer\JetPackPE;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
  public function onEnable(){
    @mkdir($this->getServer()->getDataPath() . "/plugins/JetPackPE/");
    $this->JetPackPE = (new Config($this->getDataFolder()."config.yml", Config::YAML, array(
      "JetPack" => 152,
      "NorthJetPack" => 42,
      "SouthJetPack" => 41,
      "WestJetPack" => 57,
      "EastJetPack" => 133
    )));
    $this->getLogger()->info("JetPackPE By ImSilencer.");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  public function onPlayerMove(PlayerMoveEvent $event){
    $player = $event->getPlayer();
    $block = $player->getLevel()->getBlock($player->floor()->subtract(0, 1));
    $launchpad = $this->launchPads->get("JetPack");
    $nlaunchpad = $this->launchPads->get("NorthJetPack");
    $slaunchpad = $this->launchPads->get("SouthJetPack");
    $wlaunchpad = $this->launchPads->get("WestJetPack");
    $elaunchpad = $this->launchPads->get("EastJetPack");
    if($block->getId() === $launchpad){
      if($player->getDirection() == 0){
        $player->knockBack($player, 0, 1, 0, 1);
      }
      elseif($player->getDirection() == 1){
        $player->knockBack($player, 0, 0, 1, 1);
      }
      elseif($player->getDirection() == 2){
        $player->knockBack($player, 0, -1, 0, 1);
      }
      elseif($player->getDirection() == 3){
        $player->knockBack($player, 0, 0, -1, 1);
      }    
    }
    elseif($block->getId() === $NorthJetPack){
      $player->knockBack($player, 0, -1, 0, 1);       
    }
    elseif($block->getId() === $SouthJetPack){
      $player->knockBack($player, 0, 1, 0, 1);
    }
    elseif($block->getId() === $WestJetPack){
      $player->knockBack($player, 0, 0, 1, 1);      
    }
    elseif($block->getId() === $EastJetPack){
      $player->knockBack($player, 0, 0, -1, 1);     
    }
  }
}

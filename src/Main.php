<?php

declare(strict_types=1);

namespace Lined\nightvision;

use Lined\nightvision\Command\NVCommand;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

private static Main $main;
      protected function onEnable(): void {        
          $this->getServer()->getPluginManager()->registerEvents($this,$this);        
          self::$main = $this;        
          if (!file_exists($this->getDataFolder() . "Config.yml")){            
              $this->saveResource("Config.yml");        
          }        
          $this->getServer()->getCommandMap()->register("nightvision", new NVCommand());  
          }
    
    public static function getInstance() : Main {        
        return self::$main;   
    }

}

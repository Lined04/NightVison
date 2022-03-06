<?php
namespace Lined\nightvision\Command; 

use Lined\nightvision\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\Config; 
use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\entity\effect\EffectInstance;

class nightvision extends Command { 
    public function __construct() { 
        parent::__construct("nightvision", "simuler une déconnection", "/deco", ['nv']); 
    } 
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool { 
        if (!$sender->hasPermission("nv.use") && !Server::getInstance()->isOp($sender->GetName())) {
            $sender->sendMessage("§cYou don't have permission to use this command");
            return true; 
        } 
        $config = new Config(Main::getInstance()->getDataFolder() . "Config.yml", Config::YAML);
        $msg = $config->get("message");
        $msg = str_replace("{name}", $sender->getName(), $msg);
        Server::getInstance()->broadcastMessage($msg);

        $time = $config->get("time");
        $sender->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 20 * $time, 2, true));
        return true; 
    } 
}
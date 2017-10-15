<?php

namespace famima65536\chatchannel;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class EventListener implements Listener {

  public static function register(Main $main) {
    $main->getServer()->getPluginManager()->registerEvents($main, new EventListener());
  }

  public function onChat(PlayerChatEvent $event) {

  }

  private function __construct() {
  }

}

<?php

namespace famima65536\chatchannel;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;

# Utils #
use famima65536\chatchannel\utils\ChannelManager;

class EventListener implements Listener {

  public static function register(Main $main) {
    $main->getServer()->getPluginManager()->registerEvents(new EventListener(), $main);
  }

  public function onJoin(PlayerJoinEvent $event) {
    ChannelManager::loginChannel($event->getPlayer(), ChannelManager::getPrimaryChannel());
  }

  public function onChat(PlayerChatEvent $event) {
    $channel = ChannelManager::getPlayerChannel($event->getPlayer()) ?? ChannelManager::getPrimaryChannel();
    $channel->onChat($event);
  }

  private function __construct() {
  }

}

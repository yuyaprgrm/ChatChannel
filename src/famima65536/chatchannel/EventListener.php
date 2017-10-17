<?php

namespace famima65536\chatchannel;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\server\DataPacketReceiveEvent;

# Utils #
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\WindowManager;

# Window #
use famima65536\chatchannel\ui\SelectChannelWindow;

# protocol #
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

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

  public function onTouch(PlayerInteractEvent $event) {
    $window = new SelectChannelWindow($event->getPlayer());
    WindowManager::set($window); // Set Player Window.
  }

  public function onPacketReceive(DataPacketReceiveEvent $event) {
    $pk = $event->getPacket();
    if($pk::NETWORK_ID === ModalFormResponsePacket::NETWORK_ID) {
      $player = $event->getPlayer();
      $window = WindowManager::get($player);
      $window->player = $player;
      $window->handle($pk);
    }
  }

  private function __construct() {
  }

}

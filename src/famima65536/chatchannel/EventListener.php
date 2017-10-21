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
use famima65536\chatchannel\ui\MenuWindow;

# protocol #
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

class EventListener implements Listener {

  private static $itemData;

  public static function register(Main $main) : void {
    $main->getServer()->getPluginManager()->registerEvents(new EventListener(), $main);
  }

  public function onJoin(PlayerJoinEvent $event) : void {
    ChannelManager::loginChannel($event->getPlayer(), ChannelManager::getPrimaryChannel());
  }

  public function onChat(PlayerChatEvent $event) : void {
    $channel = ChannelManager::getPlayerChannel($event->getPlayer());
    $channel->onChat($event);
  }

  public function onTouch(PlayerInteractEvent $event) : void {
    $player = $event->getPlayer();
    $item = $player->getInventory()->getItemInHand();

    if($item->getId() === self::$itemData[0] and $item->getDamage() === self::$itemData[1]) {
      $window = new MenuWindow($event->getPlayer());
      WindowManager::set($window); // Set Player Window.
    }

  }

  public function onPacketReceive(DataPacketReceiveEvent $event) : void {
    $pk = $event->getPacket();

    if($pk::NETWORK_ID === ModalFormResponsePacket::NETWORK_ID) {
      $player = $event->getPlayer();
      $window = WindowManager::get($player);
      $window->player = $player;
      $window->handle($pk);
    }

  }

  public static function setItemData(int $id, int $damage) : void {
    self::$itemData = [$id, $damage];
  }

  private function __construct() {
  }

}

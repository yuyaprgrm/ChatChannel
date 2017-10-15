<?php

namespace famima65536\chatchannel\channel;

use pocketmine\event\player\PlayerChatEvent;

class PublicChannel extends BaseChannel {

  public function onChat(PlayerChatEvent $event) {
    Parent::onChat($event);
    $event->setRecipients($this->members);
  }
}

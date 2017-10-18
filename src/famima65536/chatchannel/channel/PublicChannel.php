<?php

namespace famima65536\chatchannel\channel;

use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;

use famima65536\chatchannel\utils\Translation;

class PublicChannel extends BaseChannel {

  public function onChat(PlayerChatEvent $event) : void {
    Parent::onChat($event);
    $event->setRecipients($this->members);
  }

  public function join(Player $player) {
    Parent::join($player);
    $this->sendMessage(Translation::getMessage("channel.join", ["{%name}" => $player->getName()]));
  }
}

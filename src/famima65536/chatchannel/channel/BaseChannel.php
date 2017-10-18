<?php

namespace famima65536\chatchannel\channel;

use famima65536\chatchannel\channel\Channel;
use pocketmine\event\player\PlayerChatEvent;

use pocketmine\Player;
use famima65536\chatchannel\utils\Translation;

abstract class BaseChannel implements Channel {

  public $name, $password;
  public $id;

  protected $members = []; /** @var Player[] key => value*/

  public function __construct(string $name, string $password = "") {
    $this->name = $name;
    $this->password = $password;
    $this->members = [];
  }

  public function onChat(PlayerChatEvent $event) : void {
  }

  public function sendMessage($msg) {
    $msg = $this->name . " >> " . $msg;
    foreach($this->members as $player) {
      $player->sendMessage($msg);
    }
  }

  public function login(Player $player) {
  }

  public function join(Player $player) {
    $this->members[strtolower($player->getName())] = $player;
    $player->setDisplayName($player->getName()."§7:".$this->name);
  }

  public function quit(Player $player) {
    $this->members[strtolower($player->getName())] = null;
  }

  public function __toString() : string {
    return "name: ".$this->name.", password: ".$this->password;
  }

  public function __get(string $name) {
    return $this->{$name} ?? null;
  }
}

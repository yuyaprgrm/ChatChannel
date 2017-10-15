<?php

namespace famima65536\chatchannel\channel;

use famima65536\chatchannel\channel\Channel;
use pocketmine\event\player\PlayerChatEvent;

abstract class BaseChannel implements Channel {

  private $name, $password;
  public $id;

  protected $members = []; /** @var Player[] key => value*/

  public function __construct(string $name, string $password = "") {
    $this->name = $name;
    $this->password = $password;
    $this->members = [];
  }

  public function onChat(PlayerChatEvent $event) : bool {
    $event->setMessage($this->name." >> ".$this->getMessage());
  }

  public function login(Player $player) {
  }

  public function join(Player $player) {
    $this->members[strtolower($player->getName)] = $player;
  }

  public function quit(Player $player) {
    $this->members[strtolower($player->getName)] = null;
  }

  public function __toString() : string {
    return "name: ".$this->name.", password: ".$this->password;
  }

  public function __get(string $name) {
    return $this->{$name} ?? null;
  }
}

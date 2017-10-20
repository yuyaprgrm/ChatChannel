<?php

namespace famima65536\chatchannel\channel;

use famima65536\chatchannel\channel\Channel;
use pocketmine\event\player\PlayerChatEvent;

use pocketmine\Player;
use famima65536\chatchannel\utils\Translation;

abstract class BaseChannel implements Channel {

  public $owner; /** @var Player */
  
  public $name, $password;
  public $id;

  public $limit; /** @var int member limit*/

  protected $members = []; /** @var Player[] key => value*/

  public function __construct(string $name, string $password = "", int $limit = 0) {
    $this->name = $name;
    $this->password = $password;
    $this->members = [];
    $this->limit = $limit;
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

  public function canJoin() : bool {
    return ($this->limit === 0) or ($this->limit > count($this->members));
  }

  public function join(Player $player) {
    $this->members[strtolower($player->getName())] = $player;
    $player->setDisplayName($player->getName()."§7:".$this->name."§f");
  }

  public function quit(Player $player) {
    unset($this->members[strtolower($player->getName())]);
  }

  public function __toString() : string {
    return "name: ".$this->name.", password: ".$this->password;
  }

  public function __get(string $name) {
    return $this->{$name} ?? null;
  }
}

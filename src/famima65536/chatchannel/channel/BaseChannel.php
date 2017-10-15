<?php

namespace famima65536\chatchannel\channel;

use famima65536\chatchannel\channel\Channel;

abstract class BaseChannel implements ChatChannel {

  private $name, $password;
  public $id;

  private $members = []; /** @var Player[] */

  public function __construct(string $name, string $password) {
    $this->name     = $name;
    $this->password = $password;
    $this->members = [];
  }

  public function sendMessage(string $message) : void {
    foreach($this->members as $player) {
      $player->sendMessage($this->name." >> ".$message);
    }
  }

  public function login(Player $player) {
  }

  public function join(Player $player) {
  }

  public function quit(Player $player) {
  }

  public function __toString() : string {
    return "name: ${this->name}, password: ${this->password}";
  }

  public function __get(string $name) {
    return $this->{$name} ?? null;
  }
}

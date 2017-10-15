<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;

abstract class Window {

  public static $formId = -1;
  public $player, $formId;

  public function __construct(Player $player, int $formId = null) {
    $this->player = $player;
    $this->formId = static::$formId;
  }

  abstract public function process();

  abstract public function handle();


}

<?php

namespace famima65536\chatchannel\utils;

use famima65536\chatchannel\ui\Window;

use pocketmine\Player;

class WindowManager {

  public static $windows = [];

  public static function set(Window $window) {
    self::$windows[$window->player->getName()] = $window;
    $window->navigate();
  }

  public static function get(Player $player) {
    return self::$windows[$player->getName()] ?? null;
  }
}

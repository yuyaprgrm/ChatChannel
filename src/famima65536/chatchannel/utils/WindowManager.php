<?php

namespace famima65536\chatchannel\utils;

use famima65536\chatchannel\ui\Window;

use pocketmine\Player;

class WindowManager {

  public static $windows = [];
  public static $randomFormId;

  public static function randomFormId() {
    self::$randomFormId = mt_rand(2000, 5000000);
  }

  public static function set(Window $window, bool $process=true) {
    self::$windows[$window->player->getName()] = $window;
    $window->navigate($process);
  }

  public static function get(Player $player) {
    return self::$windows[$player->getName()] ?? null;
  }
}

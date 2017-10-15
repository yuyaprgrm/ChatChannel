<?php

namespace famima65536\chatchannel\utils;

use pocketmine\Player;
use famima65536\chatchannel\channel\Channel;

class ChannelManager {

  public static $channels = [];
  public static $players = []; /* name => id */

  public static function register(Channel $channel) {
    $id = count(self::$channels);
    $channel->id = $id;
    self::$channels[$count] = $channel;
  }

  public static function getChannel($id) {

  }

  public static function getPlayerChannel(Player $player) : Channel {
    $name = strtolower($player->getName());
    $channelId = self::$players[$name] ?? null;

    if($channelId === null) {
      return null;
    }

    return self::$channel[$channelId];
  }
}

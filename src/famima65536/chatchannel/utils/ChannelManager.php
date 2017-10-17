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
    self::$channels[$id] = $channel;
    var_dump(self::$channels);
  }

  public static function getChannel($id) : Channel {
    return self::$channels[$id] ?? null;
  }

  public static function getPrimaryChannel() : Channel {
    return self::getChannel(0);
  }

  public static function getPlayerChannel(Player $player) : Channel {
    $name = strtolower($player->getName());
    $channelId = self::$players[$name] ?? null;

    if($channelId === null) {
      return null;
    }

    return self::$channels[$channelId];
  }

  public static function loginChannel(Player $player, Channel $channel, string $password = "") {
    if($channel->password === $password or $channel->password === "") { // no password or true password.
      $channel->join($player);
      self::$players[strtolower($player->getName())] = $channel->id;
    }
  }

  public static function getAllChannels(bool $keyId=true) : array {
    if($keyId) {
      return self::$channels;
    } else {
      $channels = [];
      foreach(self::getAllChannels() as $channel) {
        $channels[] = $channel;
      }
      return $channels;
    }
  }
}

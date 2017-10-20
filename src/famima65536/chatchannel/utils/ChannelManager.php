<?php

namespace famima65536\chatchannel\utils;

use pocketmine\Player;
use famima65536\chatchannel\channel\Channel;

class ChannelManager {

  public static $channels = [];
  public static $players = []; /* name => id */

  public static function register(Channel $channel, ?Player $player=null) {

    if($player !== null) {
      self::quitChannel($player);
    }

    $id = count(self::$channels);
    $channel->id = $id;

    if($player !== null) {
      self::loginChannel($player, $channel, $channel->password);
    }

    self::$channels[$id] = $channel;
  }

  public static function unregister(Channel $channel) {
    unset(self::$channels[$channel->id]);
  }

  public static function getChannel($id) : ?Channel {
    return self::$channels[$id] ?? null;
  }

  public static function getPrimaryChannel() : Channel {
    return self::getChannel(0);
  }

  public static function getPlayerChannel(Player $player) : ?Channel {
    $name = strtolower($player->getName());
    $channelId = self::$players[$name] ?? null;

    if($channelId === null) {
      return null;
    }

    return self::$channels[$channelId] ?? null;
  }

  /**
   * プレイヤーをチャンネルに入室させます
   */
  public static function loginChannel(Player $player, Channel $channel, string $password = "") {
    if($channel->password === $password or $channel->password === "") { // no password or true password.
      $channel->join($player);
      self::$players[strtolower($player->getName())] = $channel->id;
      return true;
    }
    return false;
  }

  /**
   * プレイヤーをチャンネルから退出させます
   */
  public static function quitChannel(Player $player) {
    $channel = self::getPlayerChannel($player);

    $channel->quit($player);
    self::$players[strtolower($player->getName())] = $channel->id;

    if(count($channel->members) <= 0 and $channel !== self::getPrimaryChannel()) {
      self::unregister($channel);
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

<?php

namespace famima65536\chatchannel\channel;

use pocketmine\event\player\PlayerChatEvent;

use pocketmine\Player;
/**
 * [Interface]
 * 人の管理
 */
interface Channel {

  public function __construct(string $name, string $password = "", int $limit);

  /* send message to player in the channel. */
  public function onChat(PlayerChatEvent $event);

  /* login from out of the channel. */
  public function login(Player $player);

  /* Called after login. */
  public function join(Player $player);

  /* quit the channnel */
  public function quit(Player $player);

}

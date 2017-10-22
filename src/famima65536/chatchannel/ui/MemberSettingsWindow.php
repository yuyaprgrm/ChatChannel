<?php

namespace famima65536\chatchannel\ui;


use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\WindowManager;

class MemberSettingsWindow extends Window {

  public static $formId = 4;
  private $players = []; /** @var string[] */

  public function process() {
    $this->data = [
      "type" => "custom_form",
      "title" => Translation::getMessage("window.channelMemberManage.title"),
      "content" => [
        [
          "type" => "dropdown",
          "text" => Translation::getMessage("window.channelMemberManage.target"),
          "options" => []
        ],
        [
          "type" => "dropdown",
          "text" => Translation::getMessage("window.channelMemberManage.action"),
          "options" => [
            Translation::getMessage("window.channelMemberManage.kick"),
            Translation::getMessage("window.channelMemberManage.owner")
          ]
        ]
      ]
    ];

    $channel = ChannelManager::getPlayerChannel($this->player);

    $this->players = [];
    foreach ($channel->members as $player) {
      $this->players[] = strtolower($player->getName());
    }
    $this->data["content"][0]["options"] = $this->players;

  }

  public function handle(ModalFormResponsePacket $pk) {
    if(strpos($pk->formData, "null") !== false) { //バツが押されたら
      return;
    }

    $channel = ChannelManager::getPlayerChannel($this->player);

    $data = json_decode($pk->formData, true);

    $name = $this->players[$data[0]];
    $target = $channel->members[$name] ?? null;

    if($target === null) {
      WindowManager::set($this);
      return;
    }

    $action = $data[1];

    switch ($action) {
      case 0:
        $channel->sendMessage(Translation::getMessage("channel.kick", ["{%name}" => $target->getName()]));
        ChannelManager::quitChannel($target);
        ChannelManager::loginChannel($target, ChannelManager::getPrimaryChannel());
        break;

      case 1:
        $channel->owner = $target;
        $channel->sendMessage(Translation::getMessage("channel.ownerChange", ["{%name}" => $target->getName()]));
        break;

      default:
        WindowManager::set($this);
        break;
    }
  }

}

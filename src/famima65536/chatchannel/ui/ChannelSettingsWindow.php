<?php

namespace famima65536\chatchannel\ui;


use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\WindowManager;

class ChannelSettingsWindow extends Window {

  public static $formId = 4;

  public function process() {
    $channel = ChannelManager::getPlayerChannel($this->player);
    $this->data = [
      "type" => "custom_form",
      "title" => Translation::getMessage("window.channelSettings.title"),
      "content" => [
        [
          "type" => "input",
          "text" => Translation::getMessage("window.makeChannel.name"),
          "default" => $channel->name
        ],
        [
          "type" => "input",
          "text" => Translation::getMessage("window.makeChannel.password"),
          "default" => $channel->password
        ],
        [
          "type" => "slider",
          "text" => Translation::getMessage("window.makeChannel.memberLimit"),
          "min" => 0,
          "max" => 20,
          "default" => $channel->limit
        ]
      ]
    ];
  }

  public function handle(ModalFormResponsePacket $pk) {

  }


}

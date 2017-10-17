<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;

class SelectChannelWindow extends Window {

  public static $formId = 1;

  public function process() {
    $this->data = [
      "type" => "custom_form",
      "title" => Translation::getMessage("window.selectChannel.title"),
      "content" => [
        [
					"type" => "dropdown",
					"text" => Translation::getMessage("window.selectChannel.channels"),
					"options" => []
				]
      ]

    ];

    foreach (ChannelManager::getAllChannels() as $id => $channel) {
      $this->data["content"][0]["options"][$id] = $channel->name;
    }

  }

  public function handle(ModalFormResponsePacket $pk) {
    // var_dump($pk);
    if(strpos($pk->formData, "null") !== false) { //バツが押されたら
      $this->navigate();
    }
  }
}

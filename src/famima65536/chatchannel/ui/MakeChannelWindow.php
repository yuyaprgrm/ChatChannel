<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\WindowManager;

class MakeChannelWindow extends Window {

  public static $formId = 2;

  public function process() {
    $this->data = [
      "type" => "custom_form",
      "title" => Translation::getMessage("window.makeChannel.title"),
      "content" => [
        [
          "type" => "input",
          "text" => Translation::getMessage("window.makeChannel.name")
        ],
        [
          "type" => "slider",
          "text" => Translation::getMessage("window.makeChannel.memberLimit"),
          "min" => 0,
          "max" => 20
        ]
      ]

    ];
  }

  public function handle(ModalFormResponsePacket $pk) {
    // var_dump($pk);
    if(strpos($pk->formData, "null") !== false) { //バツが押されたら
      return;
    }

  }
}

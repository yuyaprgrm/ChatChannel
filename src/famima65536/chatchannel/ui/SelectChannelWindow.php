<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;

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
					"options" => [
            "A",
            "B"
          ]
				]
      ]

    ];
  }

  public function handle(ModalFormResponsePacket $pk) {

  }


}

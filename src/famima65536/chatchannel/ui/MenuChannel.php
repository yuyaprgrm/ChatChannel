<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\Windo;

class MenuWindow extends Window {

  public static $formId = 1;

  public function process() {
    $this->data = [
      "type" => "form",
      "title" => Translation::getMessage("window.menu.title"),
      "content" => Translation::getMessage("window.menu.subtitle"),
      "buttons" => [
        [
					"text" => Translation::getMessage("window.makeChannel.title")
				],
        [
					"text" => Translation::getMessage("window.selectChannel.title")
				],
      ]
    ];
  }

  public function handle(ModalFormResponsePacket $pk) {
    // var_dump($pk);
    if(strpos($pk->formData, "null") !== false) { //バツが押されたら
      return;
    }

    $args = explode(".", $pk->formData);
    var_dump($args);
    switch (trim($args[0])) {
      case "1":
        $window = new SelectChannelWindow($this->player);
        WindowManager::set($window);
        break;

      default:
        # code...
        break;
    }
  }
}

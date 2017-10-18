<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\WindowManager;

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

    $menuId = (int) $pk->formData;

    switch ($menuId) {
      case 0:
        $window = new MakeChannelWindow($this->player);
        break;
      case 1:
        $window = new SelectChannelWindow($this->player);
        break;

      default:
        $window = $this; // 再表示
        break;
    }

    WindowManager::set($window);
  }
}

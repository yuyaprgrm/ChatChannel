<?php

namespace famima65536\chatchannel\ui;


use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\WindowManager;

class ManageChannelWindow extends Window {

  public static $formId = 3;
  public $player;
  public $data;

  public function process() {
    $this->data = [
      "type" => "form",
      "title" => Translation::getMessage("window.manageChannel.title"),
      "content" => Translation::getMessage("window.manageChannel.subtitle"),
      "buttons" => [
        [
					"text" => Translation::getMessage("window.channelMemberManage.title")
				],
        [
					"text" => Translation::getMessage("window.channelSettings.title")
				],
      ]
    ];
  }

  public function handle(ModalFormResponsePacket $pk) {

  }


}

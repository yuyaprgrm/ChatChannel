<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use famima65536\chatchannel\channel\PublicChannel;

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
          "type" => "input",
          "text" => Translation::getMessage("window.makeChannel.password")
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

    $data = json_decode($pk->formData, true);

    if($data[0] === "") { //チャンネル名が入力されていなければ
      WindowManager::set($this);
      return;
    }

    $channel = new PublicChannel($data[0], $data[1]);
    ChannelManager::register($channel, $this->player);
  }
}

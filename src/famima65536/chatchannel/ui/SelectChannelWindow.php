<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\WindowManager;

class SelectChannelWindow extends Window {

  public static $formId = 1;
  public $channels = [];

  public function process() {
    $this->data = [
      "type" => "custom_form",
      "title" => Translation::getMessage("window.selectChannel.title"),
      "content" => [
        [
					"type" => "dropdown",
					"text" => Translation::getMessage("window.selectChannel.channels"),
					"options" => []
				],
        [
          "type" => "input",
          "text" => Translation::getMessage("window.selectChannel.password")
        ]
      ]

    ];

    $this->channels = [];
    foreach (ChannelManager::getAllChannels() as $id => $channel) {
      $this->channels[] = $id;
      $this->data["content"][0]["options"][] = $channel->name;
    }

  }

  public function handle(ModalFormResponsePacket $pk) {
    // var_dump($pk);
    if(strpos($pk->formData, "null") !== false) { //バツが押されたら再表示
      WindowManager::set($this);
      return;
    }

    $data = json_decode($pk->formData, true);
    $channel = ChannelManager::getChannel($this->channels[$data[0]]);

    if(ChannelManager::getPlayerChannel($this->player) === $channel) { //同じならそのまま
      return;
    }

    ChannelManager::quitChannel($this->player);

    if(! ChannelManager::loginChannel($this->player, $channel)) { // パスワード失敗なら再表示
      WindowManager::set($this);
    }

  }
}

<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;

abstract class Window {

  public static $formId = 0;
  public $player;
  public $data;

  public function __construct(Player $player) {
    $this->player = $player;
  }

  abstract public function process();

  abstract public function handle(ModalFormResponsePacket $pk);

  public function navigate() {
    $this->process();
    $pk = new ModalFormRequestPacket();
    $pk->formId = static::$formId;
    $pk->formData = $this->getFormJson();
    $this->player->dataPacket($pk);
  }

  public function getFormJson() : string {
    return json_encode($this->data, JSON_PRETTY_PRINT | JSON_BIGINT_AS_STRING | JSON_UNESCAPED_UNICODE);
  }


}

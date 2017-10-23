<?php

namespace famima65536\chatchannel\ui;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use famima65536\chatchannel\utils\WindowManager;

abstract class Window {

  public static $formId = -1;
  public $player;
  public $data;

  public function __construct(Player $player) {
    $this->player = $player;
  }

  abstract public function process();

  abstract public function handle(ModalFormResponsePacket $pk);

  public function navigate(bool $process) {
    if($process)$this->process();
    $pk = new ModalFormRequestPacket();
    $pk->formId = static::$formId + WindowManager::$randomFormId;
    var_dump($pk->formId);
    $pk->formData = $this->getFormJson();
    $this->player->dataPacket($pk);
  }

  public function getFormJson() : string {
    return json_encode($this->data, JSON_PRETTY_PRINT | JSON_BIGINT_AS_STRING | JSON_UNESCAPED_UNICODE);
  }


}

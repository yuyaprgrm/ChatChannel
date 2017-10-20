<?php

namespace famima65536\chatchannel\ui;


class ManageChannelWindow extends Window{

  public static $formId = 2;
  public $player;
  public $data;

  public function process() {

  }

  public function handle(ModalFormResponsePacket $pk) {

  }

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

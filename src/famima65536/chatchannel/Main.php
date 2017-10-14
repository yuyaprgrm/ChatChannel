<?php

namespace famima65536\chatchannel;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

/**
 * [Plugin]
 * APIの実装
 */
class Main extends PluginBase {

  public function onLoad() {
  }

  /**
   * 初期化処理
   */
  public function onEnable() {
    // TODO use Translation.
    $this->getLogger()->info(TF::AQUA."ChatChannel by famima65536");
  }

}

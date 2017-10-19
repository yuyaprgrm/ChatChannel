<?php

namespace famima65536\chatchannel;

# Base #
use pocketmine\plugin\PluginBase;

# Channel #
use famima65536\chatchannel\channel\PrimaryChannel;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
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
    $this->saveDefaultConfig();
    $config = $this->getConfig();
    $lang = $config->get("lang") ?? "en";
    // RegisterTranslation
    $this->saveResource("message_en.yaml");
    Translation::register($this->getDataFolder(), $lang);

    if(!Translation::existsLangFile()) {
      $this->saveResource("message_${lang}.yaml");
    }
    Translation::loadLangFile();

    ChannelManager::register(new PrimaryChannel("PRIMARY_CHANNEL"));

    $itemData = $config->get("menu-item") ?? ["id" => 353, "damage" => 0];
    EventListener::register($this);
    EventListener::setItemData($itemData["id"], $itemData["damage"]);
    // TODO use Translation.
    $this->getLogger()->info(TF::AQUA.Translation::getMessage("plugin.enable"));
  }

  /**
  * 終了処理
  */
  public function onDisable() {
    $this->getLogger()->info(TF::AQUA.Translation::getMessage("plugin.disable"));
  }

}

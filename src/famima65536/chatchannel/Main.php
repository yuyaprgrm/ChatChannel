<?php

namespace famima65536\chatchannel;

# Base #
use pocketmine\plugin\PluginBase;

# Command #
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

# Channel #
use famima65536\chatchannel\channel\PrimaryChannel;

# Utils #
use famima65536\chatchannel\utils\Translation;
use famima65536\chatchannel\utils\ChannelManager;
use famima65536\chatchannel\utils\WindowManager;
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
    $this->saveResource("message_en.yml");
    Translation::register($this->getDataFolder(), $lang);

    if(!Translation::existsLangFile()) {
      $this->saveResource("message_${lang}.yml");
    }
    Translation::loadLangFile();

    ChannelManager::register(new PrimaryChannel("PRIMARY_CHANNEL"));

    $itemData = $config->get("menu-item") ?? ["id" => 353, "damage" => 0];
    EventListener::register($this);
    EventListener::setItemData($itemData["id"], $itemData["damage"]);

    //Register WindowManager
    WindowManager::randomFormId();

    $this->getLogger()->info(TF::AQUA.Translation::getMessage("plugin.enable"));
  }

  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
    if(!strtolower($cmd->getName()) === "chatchannel") {
      return true;
    }
    $sender->sendMessage(Translation::getMessage("command.usage"));
    $sender->sendMessage(Translation::getMessage("command.credit"));
    return true;
  }

  /**
  * 終了処理
  */
  public function onDisable() {
    $this->getLogger()->info(TF::AQUA.Translation::getMessage("plugin.disable"));
  }

}

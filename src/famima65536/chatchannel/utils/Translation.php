<?php

namespace famima65536\chatchannel\utils;

use pocketmine\utils\Config;

class Translation {

  public static $directory; /** @var string path */
  public static $lang; /** @var string langName */
  public static $baseMessages = [];
  public static $messages = []; /** @var string[] messages */

  /**
   * [API]
   * 言語の登録
   *
   */
  public static function register(string $directory, string $lang="en") : void {
    self::$directory = $directory;
    self::$lang = $lang;
  }

  public static function existsLangFile(string $lang = null) : bool {
    return file_exists(self::$directory."message_".($lang ?? self::$lang ?? "").".yaml");
  }

  public static function loadLangFile() : void {
    self::$messages = self::parseMessages((new Config(self::$directory."message_".self::$lang.".yaml", Config::YAML))->getAll());
    self::$baseMessages = self::parseMessages((new Config(self::$directory."message_en.yaml", Config::YAML))->getAll());
  }

  public static function getMessage(string $msg, array $replace = []) : string {

    $message = self::$messages[$msg] ?? self::$baseMessages[$msg] ?? $msg; //最後まで見つからなかったら$msg

    return self::translate($message, $replace);
  }

  private static function translate(string $message, array $replace) : string {
    foreach($replace as $key => $value) {
      $message = preg_replace($key, $value, $message);
    }
    return $message;
  }

  /* code from simple auth! */
  private static function parseMessages(array $messages) : array {
		$result = [];
		foreach($messages as $key => $value){
			if(is_array($value)){
				foreach(self::parseMessages($value) as $k => $v){
					$result[$key . "." . $k] = $v;
				}
			}else{
				$result[$key] = $value;
			}
		}
		return $result;
	}

  private function __construct() {
  }


}

<?php

namespace famima65536\chatchannel\ui;

use pocketmine\form\Form;
use pocketmine\form\FormValidationException;
use pocketmine\player\Player;
use SimpleXMLElement;

class MenuForm implements Form {

	public function __construct(){

	}

	public function handleResponse(Player $player, $data): void{

	}


	/**
	 * @throws \Exception
	 */
	public function jsonSerialize(): array{
		return json_decode(file_get_contents(__DIR__."/view/MenuForm.json"), true);
	}

}
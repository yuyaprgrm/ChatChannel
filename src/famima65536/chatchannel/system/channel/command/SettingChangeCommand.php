<?php

namespace famima65536\chatchannel\system\channel\command;

class SettingChangeCommand {
	public function __construct(
		public ?int $maxMember=null,
		public ?bool $isPrivate=null,
		public ?string $password=null
	){}
}
<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\channel;

use famima65536\chatchannel\system\channel\command\SettingChangeCommand;
use JetBrains\PhpStorm\ArrayShape;

class ChannelSetting {

	private static int $dMaxMember = 20;
	private static bool $dIsPrivate = false;

	public static function setDefaultSetting(SettingChangeCommand $command): void{
		self::$dMaxMember = $command->maxMember ?? self::$dMaxMember;
		self::$dIsPrivate = $command->isPrivate ?? self::$dIsPrivate;
	}

	/**
	 * @return array{maxMember: int, isPrivate: bool}
	 */
	public static function getDefaultSetting(): array{
		return [
			'maxMember' => self::$dMaxMember,
			'isPrivate' => self::$dIsPrivate,
		];
	}

	public function __construct(
		public ?int $maxMember=null,
		public ?bool $isPrivate=null,
		public string $password=""
	){}

	public function hasPassword(): bool{
		return $this->password !== "";
	}
}
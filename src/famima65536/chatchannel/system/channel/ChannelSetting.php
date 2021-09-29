<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\channel;

use famima65536\chatchannel\system\channel\command\SettingChangeCommand;

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

	private int $maxMember;
	private bool $isPrivate;
	private string $password;

	public function __construct(
		?int $maxMember=null,
		?bool $isPrivate=null,
		string $password=""
	){
		$this->maxMember = $maxMember ?? self::$dMaxMember;
		$this->isPrivate = $isPrivate ?? self::$dIsPrivate;
		$this->password = $password;
	}

	public function hasPassword(): bool{
		return $this->password !== "";
	}

	/**
	 * @return int
	 */
	public function getMaxMember(): int{
		return $this->maxMember;
	}

	/**
	 * @return bool
	 */
	public function isPrivate(): bool{
		return $this->isPrivate;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string{
		return $this->password;
	}
}
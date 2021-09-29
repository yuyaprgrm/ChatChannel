<?php

namespace famima65536\chatchannel\system\command;

class ChannelCreateCommand {
	public string $userId;
	public string $channelName;
	public int $maxMember;
	public bool $isPrivate;
	public string $password;

	public function __construct(string $userId, string $channelName, int $maxMember, bool $isPrivate, string $password){
		$this->userId = $userId;
		$this->channelName = $channelName;
		$this->maxMember = $maxMember;
		$this->isPrivate = $isPrivate;
		$this->password = $password;
	}
}
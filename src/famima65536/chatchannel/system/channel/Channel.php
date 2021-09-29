<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\channel;

use ArrayObject;
use famima65536\chatchannel\system\channel\command\SettingChangeCommand;
use famima65536\chatchannel\system\user\User;
use famima65536\chatchannel\system\user\UserId;
use InvalidArgumentException;


class Channel {


	private ChannelId $id;
	private ChannelName $name;
	private UserId $owner;
	private ArrayObject $memberList;
	private ChannelSetting $setting;

	/**
	 * @param ChannelId $id
	 * @param ChannelName $name
	 * @param UserId $owner
	 * @param ArrayObject<int, UserId> $memberList
	 * @param ChannelSetting $setting
	 */
	public function __construct( ChannelId $id,  ChannelName $name,  UserId $owner,  ArrayObject $memberList,  ChannelSetting $setting){
		$this->id = $id;
		$this->name = $name;
		$this->owner = $owner;
		$this->memberList = $memberList;
		$this->setting = $setting;
	}

	public function changeSetting(SettingChangeCommand $command): void{
		$this->setting = new ChannelSetting(maxMember: $command->maxMember ?? $this->setting->getMaxMember(), isPrivate: $command->isPrivate ?? $this->setting->isPrivate(), password: $command->password ?? $this->setting->getPassword());
	}

	/**
	 * @param UserId $new
	 */
	public function addMember(UserId $new): void{
		if($this->exists($new)){
			throw new InvalidArgumentException('this user has already joined this channel.');
		}
		$this->memberList->append($new);
	}

	public function exists(UserId $id): bool{
		foreach($this->memberList as $memberId){
			if($id->equals($memberId)) return true;
		}

		return false;
	}

	public function removeMember(UserId $id): void{
		if($this->owner === $id){
			throw new InvalidArgumentException('owner cannot leave from channel');
		}

		foreach($this->memberList as $offset => $memberId){
			if($id->equals($memberId)){
				$this->memberList->offsetUnset($offset);
				return;
			}
		}
	}


	/**
	 * @return ChannelId
	 */
	public function getId(): ChannelId{
		return $this->id;
	}

}
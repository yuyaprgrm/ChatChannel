<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\user;

use ArrayObject;
use Exception;
use famima65536\chatchannel\system\channel\Channel;
use famima65536\chatchannel\system\channel\ChannelId;
use famima65536\chatchannel\system\channel\ChannelName;
use famima65536\chatchannel\system\channel\ChannelSetting;

class User{

    private UserId $id;
	private ?ChannelId $channelId;

    public function __construct(UserId $id, ?ChannelId $channelId=null){
        $this->id = $id;
		$this->channelId = $channelId;
    }

	public function getId(): UserId{
		return $this->id;
	}

	public function getChannelId(): ?ChannelId{
		return $this->channelId;
	}

	public function equals(User $other): bool{
		return $this->getId()->equals($other->getId());
	}

	/**
	 * @throws Exception when user is in another channel
	 */
	public function createChannel(ChannelId $id, ChannelName $name, ChannelSetting $setting): Channel{
		if($this->channelId !== null){
			throw new Exception('user has already joined channel');
		}

		$this->channelId = $id;

		return new Channel(
			$id,
			$name,
			$this->id,
			new ArrayObject([$this->id]),
			$setting
		);
	}

}
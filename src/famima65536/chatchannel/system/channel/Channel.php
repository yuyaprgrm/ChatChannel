<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\channel;

use ArrayObject;
use famima65536\chatchannel\system\user\User;
use InvalidArgumentException;

class Channel{

	/**
	 * @param ChannelId $id
	 * @param ChannelName $name
	 * @param User $owner
	 * @param ArrayObject<int, User> $memberList
	 */
	public function __construct(
        private ChannelId $id, 
        private ChannelName $name, 
        private User $owner,
        private ArrayObject $memberList,
		private ChannelSetting $setting
    ){
    }

    public function changeName(ChannelName $name): void{
        $this->name = $name;
    }

	/**
	 * @param User $new
	 * @throws InvalidArgumentException when new user has already joined channel.
	 */
    public function addMember(User $new): void{
		if($this->exists($new)){
			throw new InvalidArgumentException('this user has already joined this channel.');
		}
		$this->memberList->append($new);
    }

	public function exists(User $user): bool{
		foreach($this->memberList as $member){
			if($user->equals($member))return true;
		}

		return false;
	}

	/**
	 * @return ChannelId
	 */
	public function getId(): ChannelId{
		return $this->id;
	}

}
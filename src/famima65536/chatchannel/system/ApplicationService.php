<?php

namespace famima65536\chatchannel\system;

use famima65536\chatchannel\system\channel\Channel;
use famima65536\chatchannel\system\channel\ChannelId;
use famima65536\chatchannel\system\channel\ChannelName;
use famima65536\chatchannel\system\channel\ChannelSetting;
use famima65536\chatchannel\system\channel\IChannelRepository;
use famima65536\chatchannel\system\command\ChannelCreateCommand;
use famima65536\chatchannel\system\user\IUserRepository;
use famima65536\chatchannel\system\user\UserHasAlreadyJoinedChannelException;
use famima65536\chatchannel\system\user\UserId;
use famima65536\chatchannel\system\user\UserService;
use pocketmine\utils\UUID;

class ApplicationService {
	private IUserRepository $userRepository;
	private UserService $userService;
	private IChannelRepository $channelRepository;

	public function __construct(IUserRepository $userRepository, UserService $userService, IChannelRepository $channelRepository){
		$this->userRepository = $userRepository;
		$this->userService = $userService;
		$this->channelRepository = $channelRepository;
	}

	/**
	 * @throws InvalidUserException when user does not exist.
	 * @throws UserHasAlreadyJoinedChannelException
	 */
	public function createChannel(ChannelCreateCommand $command){
		$user = $this->userRepository->find(new UserId($command->userId));
		if($user === null) {
			throw new InvalidUserException();
		}

		$channel = $user->createChannel(
			new ChannelId(UUID::fromRandom()->toString()),
			new ChannelName($command->channelName),
			new ChannelSetting(
				$command->maxMember,
				$command->isPrivate,
				$command->password
			)
		);
		$this->channelRepository->save($channel);
	}

}
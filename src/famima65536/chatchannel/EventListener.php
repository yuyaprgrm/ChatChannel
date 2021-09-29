<?php

namespace famima65536\chatchannel;

use famima65536\chatchannel\system\ApplicationService;
use famima65536\chatchannel\system\channel\IChannelRepository;
use famima65536\chatchannel\system\user\IUserRepository;
use famima65536\chatchannel\system\user\User;
use famima65536\chatchannel\system\user\UserId;
use famima65536\chatchannel\system\user\UserService;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;

class EventListener implements Listener {

	private IUserRepository $userRepository;
	private UserService $userService;
	private IChannelRepository $channelRepository;
	private ApplicationService $applicationService;

	public function __construct(IUserRepository $userRepository, UserService $userService, IChannelRepository $channelRepository, ApplicationService $applicationService){
		$this->userRepository = $userRepository;
		$this->userService = $userService;
		$this->channelRepository = $channelRepository;
		$this->applicationService = $applicationService;
	}

	public function onPlayerJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$xuid = $player->getXuid();
		$user = new User(new UserId($xuid));
		if(!$this->userService->exists($user)){
			$this->userRepository->save($user);
		}
	}

	public function onPlayerChat(PlayerChatEvent $event){
	}
}
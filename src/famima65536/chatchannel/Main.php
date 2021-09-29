<?php
declare(strict_types=1);

namespace famima65536\chatchannel;

use famima65536\chatchannel\system\user\InMemoryUserRepository;
use famima65536\chatchannel\system\user\IUserRepository;
use famima65536\chatchannel\system\user\User;
use famima65536\chatchannel\system\user\UserId;
use famima65536\chatchannel\system\user\UserService;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	private IUserRepository $userRepository;
	private UserService $userService;

	public function onLoad(){
		$this->userRepository = new InMemoryUserRepository();
		$this->userService = new UserService($this->userRepository);
	}

	public function onEnable(){
		foreach($this->getServer()->getOnlinePlayers() as $player){
			$user = new User(new UserId($player->getXuid()));
			if(!$this->userService->exists($user)){
				$this->userRepository->save($user);
			}
		}

		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}

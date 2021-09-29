<?php
declare(strict_types=1);

namespace famima65536\chatchannel;

use famima65536\chatchannel\system\ApplicationService;
use famima65536\chatchannel\system\channel\Channel;
use famima65536\chatchannel\system\channel\ChannelId;
use famima65536\chatchannel\system\channel\ChannelName;
use famima65536\chatchannel\system\channel\ChannelSetting;
use famima65536\chatchannel\system\channel\InMemoryChannelRepository;
use famima65536\chatchannel\system\user\InMemoryUserRepository;
use famima65536\chatchannel\system\user\IUserRepository;
use famima65536\chatchannel\system\user\User;
use famima65536\chatchannel\system\user\UserId;
use famima65536\chatchannel\system\user\UserService;
use famima65536\chatchannel\ui\MenuForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use Ramsey\Uuid\Uuid;

class Main extends PluginBase {

	private IUserRepository $userRepository;
	private UserService $userService;
	private InMemoryChannelRepository $channelRepository;
	private ApplicationService $applicationService;

	public function onLoad(): void{
		$this->userRepository = new InMemoryUserRepository();
		$this->userService = new UserService($this->userRepository);
		$this->channelRepository = new InMemoryChannelRepository();
		$this->applicationService = new ApplicationService($this->userRepository, $this->userService, $this->channelRepository);
	}

	public function onEnable(): void{
		foreach($this->getServer()->getOnlinePlayers() as $player){
			$user = new User(new UserId($player->getXuid()));
			if(!$this->userService->exists($user)){
				$this->userRepository->save($user);
			}
		}

		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this, $this->userRepository, $this->userService, $this->channelRepository, $this->applicationService), $this);
	}

	/**
	 * @param string $xuid
	 * @return Player|null return null if not match.
	 */
	public function getOnlinePlayerByXuid(string $xuid): ?Player{
		foreach($this->getServer()->getOnlinePlayers() as $player){
			if($player->getXuid() === $xuid) return $player;
		}
		return null;
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		if(!$sender instanceof Player){
			return $this->onCommandByConsole($sender, $command, $label, $args);
		}

		$sender->sendForm(new MenuForm());

		return false;
	}

	public function onCommandByConsole(ConsoleCommandSender $sender, Command $command, string $label, array $args): bool{
		$argsCount = count($args);
		if($argsCount === 0){
			$sender->sendMessage("ChatChannel Menu");
			$sender->sendMessage("chatchannel list: list channels, including private channels");
			$sender->sendMessage("chatchannel create <channel-name> <max-member> <is-private> <password>: create channel");
			$sender->sendMessage("chatchannel delete <channel-id|channel-name>: delete channel");
			return false;
		}

		switch($args[0]){
			case 'list':
				$sender->sendMessage('list all channel');
				$channels = $this->channelRepository->findAll();
				foreach($channels as $channel){
					$sender->sendMessage("===================");
					$sender->sendMessage("name: {$channel->getName()->getValue()}");
					$sender->sendMessage("member: {$channel->countMembers()}/{$channel->getSetting()->getMaxMember()}");
				}
				break;

			case 'create':
				if($argsCount === 1){
					$sender->sendMessage('channel-name is necessary.');
				}
				$dummyUser = new User(new UserId('CONSOLE'.Uuid::getFactory()->uuid4()->toString()));
				try{
					$channel = new Channel(
						new ChannelId(Uuid::getFactory()->uuid4()->toString()),
						new ChannelName($args[1]),
						$dummyUser->getId(),
						[$dummyUser->getId()],
						new ChannelSetting(
							isset($args[2]) ? intval($args[2]) : null,
							isset($args[3]) ? boolval($args[3]) : null,
							$args[4] ?? null
						)
					);
				}catch(\InvalidArgumentException $exception){
					$sender->sendMessage($exception->getMessage());
					return false;
				}
				$this->channelRepository->save($channel);
				$sender->sendMessage('channel created!');

		}
		return false;
	}

}

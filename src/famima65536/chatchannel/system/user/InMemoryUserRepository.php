<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\user;


class InMemoryUserRepository implements IUserRepository {

	/**
	 * @var array<string, User>
	 */
	private array $store;

	public function __construct(){
		$this->store = [];
	}

	public function save(User $user): void{
		$this->store[$user->getId()->getValue()] = $user;
	}

	public function find(UserId $userId): ?User{
		return $this->store[$userId->getValue()] ?? null;
	}
}
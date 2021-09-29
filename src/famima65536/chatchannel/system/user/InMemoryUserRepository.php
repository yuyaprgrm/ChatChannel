<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\user;

use SplObjectStorage;

class InMemoryUserRepository implements IUserRepository {

	/**
	 * @var SplObjectStorage<User, User>
	 */
	private SplObjectStorage $store;

	public function __construct(){
		$this->store = new SplObjectStorage;
	}

	public function save(User $user): void{
		$this->store->attach($user);
	}

	public function find(UserId $userId): ?User{
		foreach($this->store as $cachedUser){
			/** @var $cachedUser User*/
			if($cachedUser->getId()->equals($userId)){
				return $cachedUser;
			}
		}
		return null;
	}
}
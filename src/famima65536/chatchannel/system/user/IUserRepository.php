<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\user;


interface IUserRepository {

	public function save(User $user): void;
	public function find(UserId $userId): ?User;
}
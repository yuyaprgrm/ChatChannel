<?php

namespace famima65536\chatchannel\system\user;

class UserService {
	private IUserRepository $userRepository;
	public function __construct(IUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

	public function exists(User $user): bool{
		return $this->userRepository->find($user->getId()) !== null;
	}
}
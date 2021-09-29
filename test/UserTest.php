<?php

use famima65536\chatchannel\system\user\User;
use famima65536\chatchannel\system\user\UserId;
use famima65536\chatchannel\system\user\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {


	public function testUserCreate(){
		$userRepository = new InMemoryUserRepository();
		$user = new User(
			new UserId("random-string")
		);
		$this->assertSame($user->getId()->getValue(), "random-string");

		$userRepository->save($user);
		$userCached = $userRepository->find(new UserId('random-string'));
		$this->assertTrue($userCached->equals($user));
	}

	public function testUserCompare(){
		$userA1 = new User(
			new UserId("user-a")
		);
		$userA2 = new User(
			new UserId("user-a")
		);

		$userB = new User(
			new UserId("user-b")
		);

		$this->assertTrue($userA1->equals($userA1));
		$this->assertTrue($userA1->equals($userA2));
		$this->assertNotTrue($userA1->equals($userB));
	}

	public function testHundredUsers(){

	}
}
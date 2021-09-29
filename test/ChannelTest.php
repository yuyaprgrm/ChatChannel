<?php

use famima65536\chatchannel\system\channel\Channel;
use famima65536\chatchannel\system\channel\ChannelId;
use famima65536\chatchannel\system\channel\ChannelName;
use famima65536\chatchannel\system\channel\ChannelSetting;
use famima65536\chatchannel\system\user\User;
use famima65536\chatchannel\system\user\UserId;
use PHPStan\Testing\TestCase;

class ChannelTest extends TestCase {
	public function testChannelCreate(){
		$owner = new User(
			new UserId("userA")
		);
		try{
			$channel = $owner->createChannel(
				new ChannelId('test-channel-id'),
				new ChannelName('testChannel'),
				new ChannelSetting()
			);
		}catch(Exception $exception){
			$this->assertNotTrue(true);
		}

		$this->expectException(Exception::class);
		$channelB = $owner->createChannel(
			new ChannelId('test-channel-id'),
			new ChannelName('testChannel'),
			new ChannelSetting()
		);

	}

	public function testDuplicateMember(){
		$owner = new User(new UserId('owner'));
		try{
			$channel = $owner->createChannel(new ChannelId('test'), new ChannelName('test channel'), new ChannelSetting());
		}catch(Exception $exception){
			$this->assertNotTrue(true);
			return;
		}
		$this->expectException(InvalidArgumentException::class);
		$channel->addMember($owner->getId());
	}
}
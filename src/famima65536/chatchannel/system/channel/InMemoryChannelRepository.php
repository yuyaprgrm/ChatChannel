<?php

namespace famima65536\chatchannel\system\channel;

class InMemoryChannelRepository implements IChannelRepository {

	/**
	 * @var array<string, Channel>
	 */
	private array $store;
	public function __construct(){
		$this->store = [];
	}

	public function save(Channel $channel): void{
		$this->store[$channel->getId()->getValue()] = $channel;
	}

	public function find(ChannelId $channelId): ?Channel{
		return clone $this->store[$channelId->getValue()] ?? null;
	}

	public function delete(Channel $channel): void{
		unset($this->store[$channel->getId()->getValue()]);
	}

	/**
	 * @inheritDoc
	 */
	public function findAll(): array{
		return array_map(fn($x) => clone $x, $this->store);
	}
}
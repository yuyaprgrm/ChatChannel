<?php

namespace famima65536\chatchannel\system\channel;

interface IChannelRepository {
	public function save(Channel $channel): void;
	public function find(ChannelId $channelId): ?Channel;

	/**
	 * @return Channel[]
	 */
	public function findAll(): array;
	public function delete(Channel $channel): void;
}
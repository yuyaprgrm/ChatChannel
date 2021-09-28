<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\channel;

class ChannelId{

    public function __construct(
        public string $value
    ){}

    public function getValue(): string{
        return $this->value;
    }

    public function equals(ChannelId $other): bool{
        return $other->getValue() === $this->getValue();
    }
}
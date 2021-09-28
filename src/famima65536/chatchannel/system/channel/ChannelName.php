<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\channel;

use InvalidArgumentException;

class ChannelName{
    const MAX_LENGTH = 200;
    const MIN_LENGTH = 1;

    private string $value;

    public function __construct(string $value){
        $length = mb_strlen($value);
        if($length < self::MIN_LENGTH OR self::MAX_LENGTH < $length){
            throw new InvalidArgumentException("length of name should be from {self::MIN_LENGTH} to {self::MAX_LENGTH}");
        }
        $this->value = $value;

    }

    public function getValue(): string{
        return $this->value;
    }
}
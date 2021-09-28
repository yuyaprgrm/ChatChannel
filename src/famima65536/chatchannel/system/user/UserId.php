<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\user;


class UserId{

    public function __construct(private string $value){
    }

	public function getValue(): string{
		return $this->value;
	}

	public function equals(UserId $other): bool{
		return $this->getValue() === $other->getValue();
	}

}
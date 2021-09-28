<?php
declare(strict_types=1);

namespace famima65536\chatchannel\system\user;

class User{

    private UserId $id;

    public function __construct(UserId $id){
        $this->id = $id;
    }

	public function getId(): UserId{
		return $this->id;
	}

	public function equals(User $other): bool{
		return $this->getId()->equals($other->getId());
	}

}
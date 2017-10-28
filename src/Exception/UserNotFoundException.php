<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Exception;

class UserNotFoundException extends Exception
{
    private $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public  function GetUserId()
    {
        return $userId;
    }
}
<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Exception;

use Oqq\Broetchen\Domain\User\UserId;

class UserNotFoundByIdException extends \Exception
{
    private $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public  function GetUserId()
    {
        return $this->userId;
    }
}
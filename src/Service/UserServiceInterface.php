<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Domain\User\Credentials;
use Oqq\Broetchen\Domain\User\User;
use Oqq\Broetchen\Domain\User\UserId;

interface UserServiceInterface
{
    public function getUserWithId(UserId $userId): User;

    public function getUserForCredentials(Credentials $credentials): User;
}

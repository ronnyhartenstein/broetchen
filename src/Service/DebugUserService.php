<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Domain\User\Credentials;
use Oqq\Broetchen\Domain\User\User;
use Oqq\Broetchen\Domain\User\UserId;

final class DebugUserService implements UserServiceInterface
{
    public function getUserWithId(UserId $userId): User
    {
        return $this->debugUser();
    }

    public function getUserForCredentials(Credentials $credentials): User
    {
        return $this->debugUser();
    }

    private function debugUser(): User
    {
        return User::fromArray([
            'user_id' => UserId::generate()->toString(),
        ]);
    }
}

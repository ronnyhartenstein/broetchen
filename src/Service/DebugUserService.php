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
        return $this->debugUser($userId);
    }

    public function getUserForCredentials(Credentials $credentials): User
    {
        return $this->debugUser();
    }

    private function debugUser(UserId $userId = null): User
    {
        if (null === $userId) {
            $userId = UserId::generate();
        }

        return User::fromArray([
            'user_id' => $userId->toString(),
        ]);
    }
}

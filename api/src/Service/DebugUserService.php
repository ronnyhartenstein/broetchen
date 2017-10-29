<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Command\{CreateUser, SetPassword};
use Oqq\Broetchen\Domain\User\{Credentials, User, UserId};
use Oqq\Broetchen\Domain\Exception\{LoginFailedException};

final class DebugUserService implements UserServiceInterface
{
    public function getUserWithId(UserId $userId): User
    {
        return $this->debugUser($userId);
    }

    public function getUserForCredentials(Credentials $credentials): User
    {
        if($credentials->emailAddress()->toString() === 'ich@c4c.de') { throw new LoginFailedException(); }
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

    /* AddUser
     * puts the given user into the database
     */
    public function addUser(CreateUser $user) : bool
    {
        return true;
    }

    /* AddUser
     * puts the given user into the database
     */
    public function setPassword(SetPassword $setPw) : bool
    {
        return true;
    }
}

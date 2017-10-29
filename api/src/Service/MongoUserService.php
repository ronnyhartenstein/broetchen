<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use MongoDB\Collection;
use Oqq\Broetchen\Domain\PasswordHash;
use Oqq\Broetchen\Domain\User\{
    UserId, Credentials, User
};
//use Oqq\Broetchen\Exception;
use Oqq\Broetchen\Command\{
    CreateUser, SetPassword
};
use Oqq\Broetchen\Exception\UserNotFoundByEmailException;
use Oqq\Broetchen\Exception\UserNotFoundByIdException;

class MongoUserService implements UserServiceInterface
{
    private $userCollection;
    private $pwHashService;

    public function __construct(Collection $userCollection, PasswordHashService $pwHashService)
    {
        $this->userCollection = $userCollection;
        $this->pwHashService = $pwHashService;
    }

    public function getUserWithId(UserId $userId): User
    {
        $user = $this->userCollection->findOne(['user_id' => $userId->toString()]);

        if (null === $user) {
            throw new UserNotFoundByIdException($userId);
        }

        return User::fromArray(iterator_to_array($user));
    }

    public function getUserForCredentials(Credentials $credentials): User
    {
        $user = $this->userCollection->findOne(['email_address' => $credentials->emailAddress()->toString()]);

        if (null === $user) {
            throw new UserNotFoundByEmailException($credentials->emailAddress());
        }

        $passwordHash = PasswordHash::fromString($user['password_hash']);

        if (!$credentials->password()->isValid($passwordHash, $this->pwHashService)) {
            throw new UserNotFoundByEmailException($credentials->emailAddress());
        }

        return User::fromArray(iterator_to_array($user));
    }

    public function addUser(CreateUser $user): bool
    {
        $this->userCollection->insertOne(array_merge(
            ['_id' => $user->userId()->toString()], $user->getArrayCopy())
        );

        return true;
    }

    public function setPassword(SetPassword $setPw): bool
    {
        $user = $this->userCollection->find(['user_id' => $setPw->getUserId()->toString()]);

        if (null === $user) {
            throw new UserNotFoundByIdException($setPw->getUserId());
        }

        $passwordHash = $setPw->getPassword()->hash($this->pwHashService);

        $this->userCollection->updateOne(['user_id' => $setPw->getUserId()->toString()], [
            '$set' => [
                'password_hash' => $passwordHash->toString(),
            ],
        ]);

        return true;
    }

}

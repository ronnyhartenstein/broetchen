<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use MongoDB\Collection;
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
    /** @var Collection */
    private $userCollection;

    /** @var Collection */
    private $pwHashService;

    public function __construct(Collection $userCollection, PasswordHashService $pwHashService)
    {
        $this->userCollection = $userCollection;
        $this->pwHashService = $pwHashService;
    }

    public function getUserWithId(UserId $userId): User
    {
        $user = $this->userCollection->findOne(['user_id' => $userId->toString()]);

        if (!$user->valid()) {
            throw new UserNotFoundByIdException($userId);
        }

        return User::fromArray(iterator_to_array($user));
    }

    /* getUserForCredentials
     * find user 
     */
    public function getUserForCredentials(Credentials $credentials): User
    {
        $user = $this->userCollection->findOne(['email_address' => $credentials->emailAddress()->toString()]);

        if (null === $user) {
            throw new UserNotFoundByEmailException($credentials->emailAddress());
        }

        if (!$credentials->password()->isValid($user['password_hash'], $this->pwHashService)) {
            throw new UserNotFoundByEmailException($credentials->emailAddress());
        }

        return User::fromArray(iterator_to_array($user));
    }

    /* AddUser
     * puts the given user into the database
     */
    public function addUser(CreateUser $user): bool
    {
        $this->userCollection->insertOne($user->getArrayCopy());

        return true;
    }

    /* AddUser
     * puts the given user into the database
     */
    public function setPassword(SetPassword $setPw): bool
    {
        $user = $this->userCollection->find(['user_id' => $setPw->getUserId()->toString()]);

        if (null === $user) {
            throw new UserNotFoundByIdException($setPw->getUserId());
        }

        $this->userCollection->update(['user_id' => $setPw->getUserId()->toString()], [
            'password_hash' => $setPw->getPassword()->hash($this->pwHashService)
        ]);

        return true;
    }

}

<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use MongoDB\Collection;
use Oqq\Broetchen\Domain\Credentials;
use Oqq\Broetchen\Command\CreateUser;
use Oqq\Broetchen\Command\SetPassword;
use Oqq\Broetchen\Exception;

class MongoUserService implements UserServiceInterface
{
    private $userCollection;
    private $pwHashService;

    public function getUserWithId(UserId $userId): User
    {
        $user = $userCollection->findOne(['user_id' => $userId->toString()]);

        if (!$user->valid()) { throw new UserNotFoundException($userId); } 
        
        return User::fromArray(iterator_to_array( $user ) );
    }

    /* getUserForCredentials
     * find user 
     */
    public function getUserForCredentials(Credentials $credentials): User
    {
        $user = $userCollection->findOne(['email_address' => $credentials->emailAddress->toString()]);

        if (!$user->valid()) { throw new UserNotFoundException($credentials->emailAddress); }
        if (!$credentials->password()->isValid($this->pwHashService, $user['password_hash'])) { throw new UserNotFoundException($credentials->emailAddress); }

        return User::fromArray(iterator_to_array( $user ));        
    }

    /* AddUser
     * puts the given user into the database
     */
    public function AddUser(CreateUser $user) : bool
    {
        $userCollection->insertOne($user->toArray());
        return true;
    }

    /* AddUser
     * puts the given user into the database
     */
    public function SetPassword(SetPassword $setPw) : bool
    {
        $user = $userCollection->find(['user_id' => $setPw->getUserId()->toString()]);
        if (!$user->valid()) { throw new UserNotFoundException($userId); }
        
        $userCollection->update(['user_id' => $setPw->getUserId()->toString()], ['password_hash' => $setPw->getPassword()->hash($pwHashService)]);

        return true;
    }

    public function __construct(MongoDb\ICollection $userCollection, PasswordHashService $pwHashService)
    {
        $userCollection = $userCollection;
        $pwHashService = $pwHashService;
    }
}
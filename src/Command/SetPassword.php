<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Command;

use Assert\Assertion;
use Oqq\Broetchen\Domain\User;

final class SetPassword
{
    private $password;
    private $userId;
    public static function fromArray(array $array): self
    {
        Assertion::choicesNotEmpty($values, ['password', 'user_id']);

        $password = $values['password'];
        $userId = UserId::fromString($values['user_id']);

        return new self($userId, $password);
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getPassword(): UserId
    {
        return $this->password;
    }

    private function __construct(UserId $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
}
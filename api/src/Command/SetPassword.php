<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Command;

use Assert\Assertion;
use Oqq\Broetchen\Domain\User\UserId;
use Oqq\Broetchen\Domain\User\User;
use Oqq\Broetchen\Domain\Password;

final class SetPassword
{
    private $password;
    private $userId;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['user_id', 'password']);

        $userId = UserId::fromString( $values['user_id'] );
        $password = Password::fromString( $values['password'] );

        return new self($userId, $password);
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    private function __construct(UserId $userId, Password $password)
    {
        $this->userId = $userId;
        $this->password = $password;
    }
}

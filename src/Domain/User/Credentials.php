<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\User;

use Assert\Assertion;
use Oqq\Broetchen\Domain\EmailAddress;
use Oqq\Broetchen\Domain\Password;

final class Credentials
{
    private $emailAddress;
    private $password;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['email_address', 'password']);

        $emailAddress = EmailAddress::fromString($values['email_address']);
        $password = Password::fromString($values['password']);

        return new self($emailAddress, $password);
    }

    public function emailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function password(): Password
    {
        return $this->password;
    }

    private function __construct(EmailAddress $emailAddress, Password $password)
    {
        $this->emailAddress = $emailAddress;
        $this->password = $password;
    }
}

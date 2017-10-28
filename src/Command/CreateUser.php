<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Command;

use Assert\Assertion;
use Oqq\Broetchen\Domain\EmailAddress;

final class CreateUser
{
    private $emailAddress;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['email_address']);

        $emailAddress = EmailAddress::fromString($values['email_address']);

        return new self($emailAddress);
    }

    public function emailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function getArrayCopy(): array
    {
        return [
            'email_address' => $this->emailAddress->toString(),
        ];
    }

    private function __construct(EmailAddress $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }
}

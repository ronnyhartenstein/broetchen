<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Command;

use Assert\Assertion;
use Oqq\Broetchen\Domain\EmailAddress;

final class CreateUser
{
    private $city;
    private $emailAddress;
    private $postCode;
    private $username;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['email_address', 'username', 'post_code', 'city']);

        $city = EmailAddress::fromString($values['city']);
        $emailAddress = EmailAddress::fromString($values['email_address']);
        $postlcode = EmailAddress::fromString($values['post_code']);
        $username = EmailAddress::fromString($values['username']);

        return new self($emailAddress);
    }

    public function emailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function city(): City
    {
        return $this->city;
    }

    public function postCode(): postCode
    {
        return $this->postCode;
    }

    public function username(): EmailAddress
    {
        return $this->username;
    }

    public function getArrayCopy(): array
    {
        return [
            'city' => $this->city->toString(),
            'email_address' => $this->emailAddress->toString(),
            'post_code' => $this->postCode->toString(),
            'username' => $this->username->toString(),
        ];
    }

    private function __construct(EmailAddress $emailAddress, string $username, string $postlcode, string $city)
    {
        $this->emailAddress = $emailAddress;
    }
}

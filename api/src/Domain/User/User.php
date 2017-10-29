<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\User;

use Oqq\Broetchen\Domain\User\{UserId};
use Oqq\Broetchen\Domain\{Postcode, City, EmailAddress};

use Assert\Assertion;

final class User
{
    private $userId;
    private $postcode;
    private $city;
    private $emailAddress;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['user_id']);

        $userId = UserId::fromString($values['user_id']);
        $postcode = Postcode::fromString($values['postcode']);
        $city = City::fromString($values['city']);
        $emailAddress = EmailAddress($values['email_address']);

        return new self($userId, $postcode, $city, $emailAddress);
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function postCode(): UserId
    {
        return $this->postcode;
    }

    public function city(): UserId
    {
        return $this->city;
    }

    public function emailAddress(): UserId
    {
        return $this->emailAddress;
    }

    public function getArrayCopy(): array
    {
        return [
            'user_id' => $this->userId->toString(),
            'postcode' => $this->userId->toString(),
            'city' => $this->userId->toString(),
            'email_address' => $this->email->toString(),
        ];
    }

    public function username()
    {
        
    }

    private function __construct(UserId $userId, Postcode $postcode, City $city, EmailAddress $emailAddress)
    {
        $this->userId = $userId;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->emailAddress = $emailAddress;
    }
}

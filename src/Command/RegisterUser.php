<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Command;

use Assert\Assertion;
use Oqq\Broetchen\Domain\EmailAddress;
use Oqq\Broetchen\Domain\Username;
use Oqq\Broetchen\Domain\Postcode;
use Oqq\Broetchen\Domain\City;

final class RegisterUser
{
    private $emailAddress;
    private $username;
    private $postcode;
    private $city;

    private function __construct(EmailAddress $emailAddress, Username $username, Postcode $postcode, City $city)
    {
        $this->emailAddress = $emailAddress;
        $this->username = $username;
        $this->postcode = $postcode;
        $this->city = $city;
    }

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['email_address', 'username', 'post_code', 'city']);

        $emailAddress = EmailAddress::fromString($values['email_address']);
        $username = Username::fromString($values['username']);
        $postCode = Postcode::fromString($values['post_code']);
        $city = City::fromString($values['city']);

        return new self($emailAddress, $username, $postCode, $city);
    }

    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }
    
    public function getUsername(): Username
    {
        return $this->username;
    }
    
    public function getPostcode(): Postcode
    {
        return $this->postCode;
    }
    
    public function getCity(): City
    {
        return $this->city;
    }

}
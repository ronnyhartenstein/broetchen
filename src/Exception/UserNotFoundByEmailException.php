<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Exception;

use Oqq\Broetchen\Domain\EmailAddress;
use Oqq\Broetchen\Domain\User\UserId;

class UserNotFoundByEmailException extends \Exception
{
  /** @var EmailAddress  */
    private $email;

    public function __construct(EmailAddress $email)
    {
        $this->email = $email;
    }

    public function GetUserEmail(): string
    {
        return $this->email->toString();
    }
}
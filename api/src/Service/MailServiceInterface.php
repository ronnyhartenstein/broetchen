<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Domain\EmailAddress;
use Oqq\Broetchen\Domain\MailContent;

interface MailServiceInterface
{
    public function sendMailTo(MailContent $mail, EmailAddress $emailAddress): void;
}

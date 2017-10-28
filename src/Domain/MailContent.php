<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain;

final class MailContent
{
    public function body(): string
    {
        return 'Hi!';
    }

    public function subject(): string
    {
        return 'Hi!';
    }
}

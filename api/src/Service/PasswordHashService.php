<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Domain\PasswordHash;

interface PasswordHashService
{
    public function hash(string $password): PasswordHash;

    public function isValid(string $password, PasswordHash $passwordHash): bool;

    public function needsRehash(PasswordHash $passwordHash): bool;
}

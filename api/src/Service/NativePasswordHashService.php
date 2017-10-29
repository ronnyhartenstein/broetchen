<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Domain\PasswordHash;

final class NativePasswordHashService implements PasswordHashService
{
    const DEFAULT_ALGORITHM = PASSWORD_DEFAULT;

    public function hash(string $password): PasswordHash
    {
        return PasswordHash::fromString(password_hash($password, self::DEFAULT_ALGORITHM));
    }

    public function isValid(string $password, PasswordHash $passwordHash): bool
    {
        return password_verify($password, $passwordHash->toString());
    }

    public function needsRehash(PasswordHash $passwordHash): bool
    {
        return (bool) password_needs_rehash($passwordHash->toString(), self::DEFAULT_ALGORITHM);
    }
}

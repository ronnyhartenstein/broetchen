<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain;

use Assert\Assertion;
use Oqq\Broetchen\Service\PasswordHashService;

final class Password
{
    private $value;

    public static function fromString(string $value): self
    {
        Assertion::notEmpty($value);

        return new self($value);
    }

    public function hash(PasswordHashService $hashService): PasswordHash
    {
        return $hashService->hash($this->value);
    }

    public function isValid(PasswordHash $passwordHash, PasswordHashService $hashService): bool
    {
        return $hashService->isValid($this->value, $passwordHash);
    }
    
    private function __construct(string $value)
    {
        $this->value = $value;
    }
}

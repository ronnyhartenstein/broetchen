<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain;

use Assert\Assertion;
use Oqq\Broetchen\Service\PasswordHashService;

final class PasswordHash
{
    private $value;

    public static function fromString(string $value): self
    {
        Assertion::notEmpty($value);

        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function needsRehash(PasswordHashService $hashService): bool
    {
        return $hashService->needsRehash($this);
    }
    
    private function __construct(string $value)
    {
        $this->value = $value;
    }
}

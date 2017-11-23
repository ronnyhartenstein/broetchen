<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\Product;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ProductId
{
    private $uuid;

    public static function fromString(string $value): self
    {
        return new self(Uuid::fromString($value));
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }
}

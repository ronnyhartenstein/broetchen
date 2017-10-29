<?php

declare(strict_types=1);

namespace OqqTest\Broetchen\Domain\Service;

use Oqq\Broetchen\Domain\Service\ServiceId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\Service\ServiceId
 */
class ServiceIdTest extends TestCase
{
    /**
     * @test
     * @dataProvider validValues
     */
    public function it_creates_with_valid_values(string $value): void
    {
        $productId = ServiceId::fromString($value);

        $this->assertInstanceOf(ServiceId::class, $productId);
        $this->assertSame($value, $productId->toString());
    }

    public function validValues(): array
    {
        return [
            ['ff52f6e8-c096-4363-b196-7c31039176ec'],
        ];
    }

    /**
     * @test
     */
    public function it_generates_new_id(): void
    {
        $productId = ServiceId::generate();

        $this->assertInstanceOf(ServiceId::class, $productId);
    }
}

<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Domain\Service;

use Oqq\Broetchen\Domain\Service\ServiceName;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\Service\ServiceName
 */
final class ServiceNameTest extends TestCase
{
    /**
     * @test
     * @dataProvider validValues
     */
    public function it_creates_with_valid_values(string $value): void
    {
        $product = ServiceName::fromString($value);

        $this->assertInstanceOf(ServiceName::class, $product);
        $this->assertSame($value, $product->toString());
    }

    public function validValues(): array
    {
        return [
            ['test'],
        ];
    }
}

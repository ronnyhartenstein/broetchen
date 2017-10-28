<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Domain\Service;

use Oqq\Broetchen\Domain\Service\ServiceDescription;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\Service\ServiceDescription
 */
final class ServiceDescriptionTest extends TestCase
{
    /**
     * @test
     * @dataProvider validValues
     */
    public function it_creates_with_valid_values(string $value): void
    {
        $product = ServiceDescription::fromString($value);

        $this->assertInstanceOf(ServiceDescription::class, $product);
        $this->assertSame($value, $product->toString());
    }

    public function validValues(): array
    {
        return [
            ['test'],
        ];
    }
}

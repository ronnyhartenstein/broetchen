<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Domain\Product;

use Oqq\Broetchen\Domain\Product\ProductName;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\Product\ProductName
 */
final class ProductNameTest extends TestCase
{
    /**
     * @test
     * @dataProvider validValues
     */
    public function it_creates_with_valid_values(string $value): void
    {
        $product = ProductName::fromString($value);

        $this->assertInstanceOf(ProductName::class, $product);
        $this->assertSame($value, $product->toString());
    }

    public function validValues(): array
    {
        return [
            ['test'],
        ];
    }
}

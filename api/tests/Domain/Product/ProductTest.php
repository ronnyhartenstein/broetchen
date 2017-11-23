<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Domain\Product;

use Oqq\Broetchen\Domain\Product\Product;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\Product\Product
 */
final class ProductTest extends TestCase
{
    /**
     * @test
     * @dataProvider validValues
     */
    public function it_creates_with_valid_values(array $values): void
    {
        $product = Product::fromArray($values);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertSame($values, $product->getArrayCopy());
    }

    public function validValues(): array
    {
        return [
            [
                [
                    'product_id' => 'ff52f6e8-c096-4363-b196-7c31039176ec',
                    'name' => 'test',
                ],
            ],
        ];
    }
}

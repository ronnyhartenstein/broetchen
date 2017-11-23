<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Domain\Product;

use Oqq\Broetchen\Domain\Product\Product;
use Oqq\Broetchen\Domain\Product\ProductCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @covers \Oqq\Broetchen\Domain\Product\ProductCollection
 */
final class ProductCollectionTest extends TestCase
{
    /**
     * @test
     * @dataProvider validValues
     */
    public function it_creates_with_valid_values(array $values): void
    {
        $products = ProductCollection::fromArray($values);

        $this->assertInstanceOf(ProductCollection::class, $products);
        $this->assertSame($values, $products->getArrayCopy());
    }

    public function validValues(): array
    {
        return [
            [
                [
                    [
                        'product_id' => 'ff52f6e8-c096-4363-b196-7c31039176ec',
                        'name' => 'product 1',
                    ],
                    [
                        'product_id' => 'bdbdae7f-1760-4659-88c1-c8600d4a1057',
                        'name' => 'product 2',
                    ],
                ],
            ],
        ];
    }
}

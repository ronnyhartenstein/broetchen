<?php

declare(strict_types=1);

namespace OqqTest\Broetchen\Domain\Product;

use Oqq\Broetchen\Domain\Product\ProductId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\Product\ProductId
 */
class ProductIdTest extends TestCase
{
    /**
     * @test
     * @dataProvider validValues
     */
    public function it_creates_with_valid_values(string $value): void
    {
        $productId = ProductId::fromString($value);

        $this->assertInstanceOf(ProductId::class, $productId);
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
        $productId = ProductId::generate();

        $this->assertInstanceOf(ProductId::class, $productId);
    }
}

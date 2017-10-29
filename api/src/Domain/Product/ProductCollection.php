<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\Product;

use Assert\Assertion;

final class ProductCollection
{
    private $products;

    public static function fromArray(array $values): self
    {
        Assertion::notEmpty($values);

        $products = [];

        foreach ($values as $product) {
            $products[] = Product::fromArray($product);
        }
                
        return new self(...$products);
    }

    public function getArrayCopy(): array
    {
        $products = [];

        foreach ($this->products as $product) {
            $products[] = $product->getArrayCopy();
        }

        return $products;
    }

    private function __construct(Product ...$products)
    {
        $this->products = $products;
    }
}

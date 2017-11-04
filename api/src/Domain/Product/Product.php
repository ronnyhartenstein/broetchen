<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\Product;

use Assert\Assertion;

final class Product
{
    private $productId;
    private $name;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['product_id', 'name']);

        $productId = ProductId::fromString($values['product_id']);
        $productName = ProductName::fromString($values['name']);

        return new self($productId, $productName);
    }

    public function getArrayCopy(): array
    {
        return [
            'product_id' => $this->productId->toString(),
            'name' => $this->name->toString(),
        ];
    }

    private function __construct(ProductId $productId, ProductName $name)
    {
        $this->productId = $productId;
        $this->name = $name;
    }
}

<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\Service;

use Assert\Assertion;
use Oqq\Broetchen\Domain\Product\ProductCollection;

final class Service
{
    private $serviceId;
    private $name;
    private $description;
    private $products;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['service_id', 'name', 'description']);

        $serviceId = ServiceId::fromString($values['service_id']);
        $name = ServiceName::fromString($values['name']);
        $description = ServiceDescription::fromString($values['description']);

        $products = $values['products'] ? ProductCollection::fromArray($values['products']) : null;

        return new self($serviceId, $name, $description, $products);
    }

    public function getArrayCopy(): array
    {
        return [
            'service_id' => $this->serviceId->toString(),
            'name' => $this->name->toString(),
            'description' => $this->description->toString(),
            'products' => $this->products ? $this->products->getArrayCopy() : null,
        ];
    }

    private function __construct(
        ServiceId $serviceId,
        ServiceName $name,
        ServiceDescription $description,
        ?ProductCollection $products
    ) {
        $this->serviceId = $serviceId;
        $this->name = $name;
        $this->description = $description;
        $this->products = $products;
    }
}

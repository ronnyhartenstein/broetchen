<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\Service;

use Assert\Assertion;
use Oqq\Broetchen\Domain\Service\{ServiceId, ServiceName};
use Oqq\Broetchen\Domain\Product\ProductCollection;
use Oqq\Broetchen\Domain\User\UserId;

final class Service
{
    private $serviceId;
    private $name;
    private $description;
    private $products;
    private $userId;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['service_id', 'user_id', 'name', 'description', 'products']);

        $serviceId = ServiceId::fromString($values['service_id']);
        $userId = UserId::fromString($values['user_id']);
        $name = ServiceName::fromString($values['name']);
        $description = ServiceDescription::fromString($values['description']);        
        $products = ProductCollection::fromArray($values['products']);

        return new self($serviceId, $userId, $name, $description, $products);
    }

    public function getArrayCopy(): array
    {
        return [
            'service_id' => $this->serviceId->toString(),
            'user_id' => $this->userId->toString(),
            'name' => $this->name->toString(),
            'description' => $this->description->toString(),
            'products' => $this->products->getArrayCopy(),
        ];
    }

    private function __construct(
        ServiceId $serviceId,
        UserId $userId,
        ServiceName $name,
        ServiceDescription $description,
        ?ProductCollection $products
    ) {
        $this->serviceId = $serviceId;
        $this->userId = $userId;
        $this->name = $name;
        $this->description = $description;
        $this->products = $products;
    }
}

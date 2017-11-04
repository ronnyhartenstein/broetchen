<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\Order;

use Assert\Assertion;
use Oqq\Broetchen\Domain\Money;

final class Order
{
    private $orderId;
    private $name;
    private $price;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['order_id', 'name', 'price']);

        $orderId = OrderId::fromString($values['order_id']);
        $name = OrderName::fromString($values['name']);
        $price = Money::fromString($values['price']);

        return new self($orderId, $name, $price);
    }

    public function orderId(): OrderId
    {
        return $this->orderId;
    }

    public function getArrayCopy(): array
    {
        return [
            'order_id' => $this->orderId->toString(),
            'name' => $this->name->toString(),
            'price' => $this->price->toString(),
        ];
    }

    private function __construct(OrderId $orderId, OrderName $name, Money $price)
    {
        $this->orderId = $orderId;
        $this->name = $name;
        $this->price = $price;
    }
}

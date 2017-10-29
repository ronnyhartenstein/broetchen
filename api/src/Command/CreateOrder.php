<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Command;

use Assert\Assertion;
use Oqq\Broetchen\Domain\Order\Order;

final class CreateOrder
{
    private $order;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['order']);

        $order = Order::fromArray($values['order']);

        return new self($order);
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function getArrayCopy(): array
    {
        return [
            'order' => $this->order->getArrayCopy(),
        ];
    }

    private function __construct(Order $order)
    {
        $this->order = $order;
    }
}

<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use MongoDB\Collection;
use Oqq\Broetchen\Command\CreateOrder;
use Oqq\Broetchen\Domain\Order\Order;
use Oqq\Broetchen\Domain\Order\OrderId;
use Oqq\Broetchen\Exception\OrderNotFoundByIdException;

final class MongoOrderService implements OrderServiceInterface
{
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function getOrderWithId(OrderId $orderId): Order
    {
        $order = $this->collection->findOne(['order_id' => $orderId->toString()]);

        if (null === $order) {
            throw new OrderNotFoundByIdException($orderId);
        }

        return Order::fromArray(iterator_to_array($order));
    }

    public function addOrder(CreateOrder $command)
    {
        $order = $command->order();

        $this->collection->insertOne(array_merge(
            ['_id' => $order->orderId()->toString()], $order->getArrayCopy())
        );
    }
}

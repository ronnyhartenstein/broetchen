<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Command\CreateOrder;
use Oqq\Broetchen\Domain\Order\Order;
use Oqq\Broetchen\Domain\Order\OrderId;

interface OrderServiceInterface
{
    public function getOrderWithId(OrderId $orderId): Order;

    public function addOrder(CreateOrder $order);
}

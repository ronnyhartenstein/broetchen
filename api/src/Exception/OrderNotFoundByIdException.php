<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Exception;

use Oqq\Broetchen\Domain\Order\OrderId;

class OrderNotFoundByIdException extends \Exception
{
    private $orderId;

    public function __construct(OrderId $orderId)
    {
        $this->orderId = $orderId;
    }

    public function orderId(): OrderId
    {
        return $this->orderId;
    }
}

<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Command;

use Assert\Assertion;
use Oqq\Broetchen\Domain\Service\Service;
use Oqq\Broetchen\Domain\User\UserId;

final class CreateService
{
    private $service;

    public static function fromArray(array $values): self
    {
        $service = Service::fromArray($values);

        return new self($service);
    }

    public function service(): Service
    {
        return $this->service;
    }

    private function __construct(Service $service)
    {
        $this->service = $service;
    }
}

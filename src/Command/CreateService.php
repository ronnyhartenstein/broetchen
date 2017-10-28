<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Command;

use Assert\Assertion;
use Oqq\Broetchen\Domain\Service\Service;
use Oqq\Broetchen\Domain\User\UserId;

final class CreateService
{
    private $userId;
    private $service;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['user_id', 'service']);

        $userId = UserId::fromString($values['user_id']);
        $service = Service::fromArray($values['service']);

        return new self($userId, $service);
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function service(): Service
    {
        return $this->service;
    }

    private function __construct(UserId $userId, Service $service)
    {
        $this->userId = $userId;
        $this->service = $service;
    }
}

<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Domain\User;

use Assert\Assertion;

final class User
{
    private $userId;

    public static function fromArray(array $values): self
    {
        Assertion::choicesNotEmpty($values, ['user_id']);

        $userId = UserId::fromString($values['user_id']);

        return new self($userId);
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function getArrayCopy(): array
    {
        return [
            'user_id' => $this->userId->toString(),
        ];
    }

    private function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }
}

<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Command;

use Ramsey\Uuid\Uuid;
use Oqq\Broetchen\Command\SetPassword;
use Oqq\Broetchen\Domain\UserId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\CreateUser
 */
final class SetPasswordTest extends TestCase
{
    /**
     * @test
     * @dataProvider getValidContents
     */
    public function it_creates_with_valid_value(array $value): void
    {
        $setPassword = SetPassword::fromArray($value);

        $this->assertInstanceOf(SetPassword::class, $setPassword);
        $this->assertEquals($value['user_id'], $setPassword->getUserId()->toString());
    }

    public function getValidContents(): array
    {
        return [
            [['password' => 'pw',
             'user_id' => Uuid::uuid4()->toString(),]],
        ];
    }

    /**
     * @test
     * @coversNothing
     * @dataProvider getInvalidContents
     */
    public function it_throws_exception_with_invalid_value($value): void
    {
        $this->expectException(\Throwable::class);

        EmailAddress::fromString($value);
    }

    public function getInvalidContents(): array
    {
        return [
            [['user_id' => 'user']],
            [null],
            [2],
            [-2],
            [1.123],
            [[]],
            ['abc.de'],
        ];
    }
}

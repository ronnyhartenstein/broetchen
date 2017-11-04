<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Command;

use Oqq\Broetchen\Command\SetPassword;
use Oqq\Broetchen\Domain\Password;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Command\SetPassword
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
        $this->assertSame($value['user_id'], $setPassword->getUserId()->toString());

        $this->assertInstanceOf(Password::class, $setPassword->getPassword());
    }

    public function getValidContents(): array
    {
        return [
            [
                [
                    'password' => 'pw',
                    'user_id' => 'ea50279a-48e3-4548-8468-b17f0ab17271'
                ]
            ],
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

        SetPassword::fromArray($value);
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

<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Command;

use Oqq\Broetchen\Command\CreateUser;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Command\CreateUser
 */
final class CreateUserTest extends TestCase
{
    /**
     * @test
     * @dataProvider getValidContents
     */
    public function it_creates_with_valid_value(array $value): void
    {
        $createUser = CreateUser::fromArray($value);

        $this->assertInstanceOf(CreateUser::class, $createUser);
        $this->assertEquals($value, $createUser->getArrayCopy());
    }

    public function getValidContents(): array
    {
        return [
            [['post_code' => '09130',
             'email_address' => 'ich@aol.com',
             'username' => 'user',
             'city' => 'Chemnitz']],
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

        CreateUser::fromArray($value);
    }

    public function getInvalidContents(): array
    {
        return [
            ['email_address' => 'ich@aol.com',],
            ['post_code' => '09130',
            'username' => 'user',
            'city' => 'Chemnitz'],
            ['post_code' => '',
            'email_address' => '',
            'username' => '',
            'city' => ''],
            [null],
            [2],
            [-2],
            [1.123],
            [[]],
            ['abc.de'],
        ];
    }
}

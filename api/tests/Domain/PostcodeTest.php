<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Domain;

use Oqq\Broetchen\Domain\Postcode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\Postcode
 */
final class PostCodeTest extends TestCase
{
    /**
     * @test
     * @dataProvider getValidContents
     */
    public function it_creates_with_valid_value(string $value): void
    {
        $postCode = Postcode::fromString($value);

        $this->assertInstanceOf(Postcode::class, $postCode);
        $this->assertSame($value, $postCode->toString());
    }

    public function getValidContents(): array
    {
        return [
            ['09130'],
            ['09114'],
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
            [''],
            ['9130'],
            ['091300'],
            [null],
            [2],
            [-2],
            [1.123],
            [[]],
            ['abc.de'],
        ];
    }
}

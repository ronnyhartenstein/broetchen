<?php

declare(strict_types = 1);

namespace OqqTest\Broetchen\Domain\Service;

use Oqq\Broetchen\Domain\Service\Service;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Oqq\Broetchen\Domain\Service\Service
 */
final class ServiceTest extends TestCase
{
    /**
     * @test
     * @dataProvider validValues
     */
    public function it_creates_with_valid_values(array $values): void
    {
        $service = Service::fromArray($values);

        $this->assertInstanceOf(Service::class, $service);
        $this->assertSame($values, $service->getArrayCopy());
    }

    public function validValues(): array
    {
        return [
            [
                [
                    'service_id' => 'ff52f6e8-c096-4363-b196-7c31039176ec',
                    'user_id' => 'ada31364-c3b8-455d-b1c4-73be2bb23348',
                    'name' => 'test',
                    'description' => 'test',
                    'products' => [
                        [
                            'product_id' => '1c4a118e-0ddb-4798-9040-a364ec690ad3',
                            'name' => 'test',
                        ],
                    ],
                ],
            ],
        ];
    }
}

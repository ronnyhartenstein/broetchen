<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use MongoDB\Collection;
use Oqq\Broetchen\Domain\Service\Service;
use Oqq\Broetchen\Domain\SearchPattern;

final class MongoServiceService implements ServiceServiceInterface
{
    private $serviceCollection;
    private $userService;

    public function __construct(Collection $serviceCollection, UserServiceInterface $userService)
    {
        $this->serviceCollection = $serviceCollection;
        $this->userService = $userService;
    }

    public function findService(SearchPattern $pattern): array
    {
        $services = $this->serviceCollection->find([
            'name' => [
                '$regex' => '.+' . $pattern->toString() . '.+'
            ],
            'description' => [
                '$regex' => '.+' . $pattern->toString() . '.+'
            ]
        ]);

        $returnValue = [];
        foreach ($services as $key => $value) {
            $returnValue[] = Service::fromArray(iterator_to_array($value));
        }

        return $returnValue;
    }
}

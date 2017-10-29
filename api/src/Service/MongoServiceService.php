<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use MongoDB\Collection;
use Oqq\Broetchen\Service\ServiceServiceInterface;
use Oqq\Broetchen\Domain\User\User;
use Oqq\Broetchen\Domain\User\UserId;
use Oqq\Broetchen\Domain\Service\Service;
use Oqq\Broetchen\Domain\SearchPattern;

final class MongoServiceService implements ServiceServiceInterface
{
    public function __construct(Collection $serviceCollection, UserServiceInterface $userService)
    {
      $this->serviceCollection = $serviceCollection;
    }

    private $serviceCollection;

    public function findService(SearchPattern $pattern): array
    {
        $userId = UserId::fromString( $request->getAttribute('user_id') );

        $user = $this->userService->getUserWithId($userId);

        $services = $serviceCollection->find(['name' => ['$regex' => '.+'.$pattern.'.+'], 
            'description' => ['$regex' => '.+'.$pattern.'.+'],]);

        $returnValue = [];
        foreach ($services as $key => $value)
        {
            $returnValue[] = Service::fromArray(iterator_to_array($value));
        }  

        return $returnValue;
    }
}

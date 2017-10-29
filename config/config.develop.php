<?php

declare(strict_types=1);

return [
    'debug' => true,
    \Zend\ConfigAggregator\ConfigAggregator::ENABLE_CACHE => false,

    'router' => [
        'fastroute' => [
            \Zend\Expressive\Router\FastRouteRouter::CONFIG_CACHE_ENABLED => false,
        ],
    ],

    'dependencies' => [
        'aliases' => [
            \Oqq\Broetchen\Service\UserServiceInterface::class => \Oqq\Broetchen\Service\DebugUserService::class,
        ],
        'factories' => [
            \Oqq\Broetchen\Service\DebugUserService::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ],
    ],
];

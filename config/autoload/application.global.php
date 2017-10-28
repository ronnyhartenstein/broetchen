<?php

declare(strict_types=1);

return [
    'debug' => false,
    \Zend\ConfigAggregator\ConfigAggregator::ENABLE_CACHE => true,

    'application' => [
        'name' => 'broetchen',
        'version' => 'dev',
    ],

    'dependencies' => [
        'aliases' => [
        ],
        'factories' => [
        ],
    ],

    \Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory::class => [
        \Oqq\Broetchen\Middleware\PingMiddleware::class => [
            \Zend\Expressive\Hal\ResourceGenerator::class,
            \Zend\Expressive\Hal\HalResponseFactory::class,
        ],
    ],
];

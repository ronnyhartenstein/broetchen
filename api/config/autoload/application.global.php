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
            \Oqq\Broetchen\Middleware\JsonCommandMiddleware::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Tuupola\Middleware\Cors::class => \Oqq\Broetchen\Container\CorsMiddlewareFactory::class,
        ],
    ],

    \Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory::class => [
        \Oqq\Broetchen\Middleware\PingMiddleware::class => [
            \Zend\Expressive\Hal\ResourceGenerator::class,
            \Zend\Expressive\Hal\HalResponseFactory::class,
        ],
        \Oqq\Broetchen\Middleware\LoginMiddleware::class => [
            \Oqq\Broetchen\Service\UserServiceInterface::class,
        ],
        \Oqq\Broetchen\Middleware\AuthenticationMiddleware::class => [
            \Oqq\Broetchen\Service\UserServiceInterface::class,
        ],
        \Oqq\Broetchen\Middleware\UserDataMiddleware::class => [
            \Oqq\Broetchen\Service\UserServiceInterface::class,
            \Zend\Expressive\Hal\ResourceGenerator::class,
            \Zend\Expressive\Hal\HalResponseFactory::class,
        ],
        \Oqq\Broetchen\Middleware\RegisterMiddleware::class => [
            \Oqq\Broetchen\Service\UserServiceInterface::class
        ],
    ],
];

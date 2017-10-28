<?php

declare(strict_types=1);

return [
    'los-cors' => [
        'allowed_origins' => ['*'],
        'allowed_methods' => ['GET', 'OPTIONS'],
        'allowed_headers' => ['Authorization', 'Accept', 'Content-Type'],
        'max_age' => 120,
        'expose_headers' => [],
        'allowed_credentials' => true,
    ],

    'dependencies' => [
        'factories' => [
            \LosMiddleware\LosCors\CorsMiddleware::class => \LosMiddleware\LosCors\CorsMiddlewareFactory::class,
        ],
    ],
];

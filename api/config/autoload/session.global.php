<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'factories' => [
            \PSR7Sessions\Storageless\Http\SessionMiddleware::class => \Oqq\Broetchen\Container\SessionMiddlewareFactory::class,
        ],
    ],

    'session' => [
        'symmetric_key' => base64_encode(openssl_random_pseudo_bytes(32)),
        'expiration_time' => 604800,
        'cookie_name' => 'broetchen',
    ],
];

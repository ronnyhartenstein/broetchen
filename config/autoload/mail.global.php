<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'aliases' => [
        ],
        'factories' => [
            'mail.default' => [\Oqq\Broetchen\Container\MailTransportFactory::class, 'default'],
        ],
    ],

    'mail' => [
        'transports' => [
            'default' => [
                'type' => 'smtp',
                'from' => '',
                'options' => [
                    'host' => '',
                    'port' => 587,
                    'connection_class'  => 'plain',
                    'connection_config' => [
                        'username' => '',
                        'password' => '',
                        'ssl' => 'tls',
                    ],
                ],
            ],
        ],
    ],
];

<?php

declare(strict_types=1);

return function (\Zend\Expressive\Application $app): void {
    $app->route('/api/ping', \Oqq\Broetchen\Middleware\PingMiddleware::class);


    $app->post('/api/login', [
        \Oqq\Broetchen\Middleware\LoginMiddleware::class,
        \Oqq\Broetchen\Middleware\JsonCommandMiddleware::class,
    ]);

    $app->get('/api/user', [
        \Oqq\Broetchen\Middleware\UserDataMiddleware::class,
    ]);
};

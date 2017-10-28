<?php

declare(strict_types=1);

return function (\Zend\Expressive\Application $app): void {
    $app->route('/api/ping', \Oqq\Broetchen\Middleware\PingMiddleware::class);
};

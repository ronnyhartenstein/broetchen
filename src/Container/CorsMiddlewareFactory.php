<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Container;

use Psr\Container\ContainerInterface;
use Tuupola\Middleware\Cors;

final class CorsMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): Cors
    {
        return new Cors([
            "origin" => ["*"],
            "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
            "headers.allow" => [],
            "headers.expose" => [],
            "credentials" => false,
            "cache" => 0,
        ]);
    }
}

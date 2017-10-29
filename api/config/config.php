<?php

declare(strict_types=1);

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

return (function (): array {
    $cacheConfig = [
        'config_cache_path' => 'data/config-cache.php',
    ];

    $aggregator = new ConfigAggregator([
        \Zend\Expressive\Hal\ConfigProvider::class,
        \Zend\ProblemDetails\ConfigProvider::class,
        \Zend\Hydrator\ConfigProvider::class,
        new ArrayProvider($cacheConfig),
        new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),
        new PhpFileProvider('config/config.develop.php'),
    ], $cacheConfig['config_cache_path']);

    return $aggregator->getMergedConfig();
})();

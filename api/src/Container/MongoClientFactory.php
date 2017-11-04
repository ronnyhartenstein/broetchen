<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Container;

use Interop\Config\ConfigurationTrait;
use Interop\Config\RequiresConfig;
use MongoDB\Client;
use Psr\Container\ContainerInterface;

final class MongoClientFactory implements RequiresConfig
{
    use ConfigurationTrait;

    public function __invoke(ContainerInterface $container): Client
    {
        $config = $container->get('config');
        $options = $this->options($config);

        return new Client($options['server']);
    }

    public function dimensions(): iterable
    {
        return ['mongodb'];
    }
}

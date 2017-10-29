<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Container;

use Interop\Config\ConfigurationTrait;
use Interop\Config\RequiresConfig;
use MongoDB\Client;
use MongoDB\Collection;
use Psr\Container\ContainerInterface;

final class MongoCollectionFactory implements RequiresConfig
{
    use ConfigurationTrait;

    private $configId;

    public static function __callStatic(string $name, array $arguments): Collection
    {
        if (! isset($arguments[0]) || ! $arguments[0] instanceof ContainerInterface) {
            throw new \InvalidArgumentException(
                sprintf('The first argument must be of type %s', ContainerInterface::class)
            );
        }

        return (new static($name))->__invoke($arguments[0]);
    }

    public function __construct(string $configId)
    {
        $this->configId = $configId;
    }

    public function __invoke(ContainerInterface $container): Collection
    {
        $config = $container->get('config');
        $options = $this->options($config);

        $mongoClient = $container->get(Client::class);

        return $mongoClient->selectCollection($options['database'], $this->configId);
    }

    public function dimensions(): iterable
    {
        return ['mongodb'];
    }
}

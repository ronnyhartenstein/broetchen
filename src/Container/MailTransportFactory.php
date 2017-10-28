<?php

declare(strict_types = 1);

namespace Oqq\Broetchen\Container;

use Interop\Config\ConfigurationTrait;
use Interop\Config\RequiresConfig;
use Interop\Config\RequiresConfigId;
use Interop\Config\RequiresMandatoryOptions;
use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use Zend\Mail\Transport\Envelope;
use Zend\Mail\Transport\Factory;
use Zend\Mail\Transport\File;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\TransportInterface;

final class MailTransportFactory implements RequiresConfig, RequiresConfigId, RequiresMandatoryOptions
{
    use ConfigurationTrait;

    private $configId;

    public static function __callStatic(string $name, array $arguments): TransportInterface
    {
        if (! isset($arguments[0]) || ! $arguments[0] instanceof ContainerInterface) {
            throw new InvalidArgumentException(
                sprintf('The first argument must be of type %s', ContainerInterface::class)
            );
        }

        return (new static($name))->__invoke($arguments[0]);
    }

    public function __construct(string $configId)
    {
        $this->configId = $configId;
    }

    public function __invoke(ContainerInterface $container): TransportInterface
    {
        $config = $container->get('config');
        $options = $this->options($config, $this->configId);

        $transport = Factory::create($options);

        if (isset($options['from']) && $transport instanceof Smtp) {
            $envelope = new Envelope();
            $envelope->setFrom($options['from']);

            $transport->setEnvelope($envelope);
        }

        return $transport;
    }

    public function dimensions(): iterable
    {
        return ['mail', 'transports'];
    }

    public function mandatoryOptions(): iterable
    {
        return ['type'];
    }
}

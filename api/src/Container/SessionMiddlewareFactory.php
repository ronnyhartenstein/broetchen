<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Container;

use Dflydev\FigCookies\SetCookie;
use Interop\Config\ConfigurationTrait;
use Interop\Config\ProvidesDefaultOptions;
use Interop\Config\RequiresConfig;
use Interop\Config\RequiresMandatoryOptions;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Psr\Container\ContainerInterface;
use PSR7Sessions\Storageless\Http\SessionMiddleware;
use PSR7Sessions\Storageless\Time\SystemCurrentTime;

final class SessionMiddlewareFactory implements RequiresConfig, RequiresMandatoryOptions, ProvidesDefaultOptions
{
    use ConfigurationTrait;

    public function __invoke(ContainerInterface $container): SessionMiddleware
    {
        $config = $container->get('config');
        $options = $this->options($config);

        $cookie = SetCookie::create($options['cookie_name'])
            ->withHttpOnly(true)
            ->withPath('/');

        if (false !== $options['secure']) {
            $cookie = $cookie->withSecure(true);
        }

        return new SessionMiddleware(
            new Sha256(),
            $options['symmetric_key'],
            $options['symmetric_key'],
            $cookie,
            new Parser(),
            $options['expiration_time'],
            new SystemCurrentTime()
        );
    }

    public function dimensions(): iterable
    {
        return ['session'];
    }

    public function mandatoryOptions(): iterable
    {
        return ['symmetric_key', 'expiration_time', 'cookie_name'];
    }

    public function defaultOptions(): iterable
    {
        return ['secure' => true];
    }
}

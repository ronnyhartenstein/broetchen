<?php

declare(strict_types=1);

return [
    'zend-expressive' => [
        'programmatic_pipeline' => true,
        'raise_throwables' => true,
    ],

    'router' => [
        'fastroute' => [
            \Zend\Expressive\Router\FastRouteRouter::CONFIG_CACHE_ENABLED => true,
            \Zend\Expressive\Router\FastRouteRouter::CONFIG_CACHE_FILE => 'data/fastroute-cache.php',
        ],
    ],

    'dependencies' => [
        'factories' => [
            \Zend\Expressive\Application::class => \Zend\Expressive\Container\ApplicationFactory::class,
            \Zend\Expressive\Router\RouterInterface::class => \Zend\Expressive\Router\FastRouteRouterFactory::class,

            \Zend\Expressive\Helper\UrlHelper::class => \Zend\Expressive\Helper\UrlHelperFactory::class,
            \Zend\Expressive\Helper\UrlHelperMiddleware::class => \Zend\Expressive\Helper\UrlHelperMiddlewareFactory::class,
            \Zend\Expressive\Helper\ServerUrlHelper::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Zend\Expressive\Helper\ServerUrlMiddleware::class => \Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class,

            \Zend\Stratigility\Middleware\OriginalMessages::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Zend\Stratigility\Middleware\ErrorHandler::class => \Zend\Expressive\Container\ErrorHandlerFactory::class,

            \Zend\Expressive\Middleware\ImplicitHeadMiddleware::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Zend\Expressive\Middleware\ImplicitOptionsMiddleware::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            \Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class => \Zend\ServiceManager\Factory\InvokableFactory::class,

            \Zend\Expressive\Delegate\NotFoundDelegate::class => \Zend\Expressive\Container\NotFoundDelegateFactory::class,
            \Zend\Expressive\Middleware\NotFoundHandler::class => \Zend\Expressive\Container\NotFoundHandlerFactory::class,
        ],
        'abstract_factories' => [
            \Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory::class,
        ],
    ],
];

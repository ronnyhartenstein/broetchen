<?php

declare(strict_types=1);

return function (\Zend\Expressive\Application $app) {
    $app->pipe(\Zend\Stratigility\Middleware\OriginalMessages::class);
    $app->pipe(\Zend\Stratigility\Middleware\ErrorHandler::class);
    $app->pipe(\Zend\Expressive\Helper\ServerUrlMiddleware::class);
    $app->pipe(\PSR7Sessions\Storageless\Http\SessionMiddleware::class);
    $app->pipe(\LosMiddleware\LosCors\CorsMiddleware::class);

    $app->pipeRoutingMiddleware();

    $app->pipe( \Zend\ProblemDetails\ProblemDetailsMiddleware::class);

    $app->pipe(\Oqq\Broetchen\Middleware\AuthenticationMiddleware::class);
    $app->pipe(\Zend\Expressive\Middleware\ImplicitHeadMiddleware::class);
    $app->pipe(\Zend\Expressive\Middleware\ImplicitOptionsMiddleware::class);
    $app->pipe(\Zend\Expressive\Helper\UrlHelperMiddleware::class);
    $app->pipe(\Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class);

    $app->pipe('/api', \Zend\ProblemDetails\ProblemDetailsMiddleware::class);

    $app->pipeDispatchMiddleware();

    $app->pipe(\Zend\Expressive\Middleware\NotFoundHandler::class);
};

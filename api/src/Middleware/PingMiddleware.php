<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

final class PingMiddleware implements MiddlewareInterface
{
    private $resourceGenerator;
    private $responseFactory;

    public function __construct(ResourceGenerator $resourceGenerator, HalResponseFactory $responseFactory)
    {
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $resource = $this->resourceGenerator->fromArray([
            'ack' => (float) (new \DateTime())->format('U.u'),
        ]);

        return $this->responseFactory->createResponse($request, $resource);
    }
}

<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Oqq\Broetchen\Service\ServiceServiceInterface;
use Oqq\Broetchen\Domain\SearchPattern;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

final class FindServiceMiddleware implements MiddlewareInterface
{
    private $serviceService;
    private $resourceGenerator;
    private $responseFactory;

    public function __construct(
        ServiceServiceInterface $serviceService,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory
    ) {
        $this->serviceService = $serviceService;
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $userId = $request->getAttribute('user_id');

        $pattern = SearchPattern::fromString($request->getAttribute('pattern'));

        $services = $this->serviceService->findService($pattern);

        $resource = $this->resourceGenerator->fromArray([
            'services' => $services,
        ]);

        return $this->responseFactory->createResponse(
            $request, $resource
        );
    }
}

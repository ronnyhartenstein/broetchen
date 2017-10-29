<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Oqq\Broetchen\Service\{UserServiceInterface, ServiceServiceInterface};
use Oqq\Broetchen\Domain\{SearchPattern};

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

final class FindServiceMiddleware implements MiddlewareInterface
{
    
    public function __construct(
        UserServiceInterface $userService,
        ServiceServiceInterface $serviceService,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory
    ) {
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->userService = $userService;
        $this->serviceService = $serviceService;
    }

    private $resourceGenerator;
    private $responseFactory;
    private $userService;
    private $serviceService;

    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $userId = $request->getAttribute('user_id');

        $user = $this->userService->getUserWithId($userId);

        $pattern = SearchPattern::fromString( $request->getAttribute('pattern') );

        $serviceService->findService($pattern);

        $resource = $this->resourceGenerator->fromArray([
            'services' => $serviceService,
        ]);

        return $this->responseFactory->createResponse(
            $request, $resource
        );
    }
}

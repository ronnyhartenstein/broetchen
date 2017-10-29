<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Oqq\Broetchen\Service\UserServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

final class RegisterMiddleware implements MiddlewareInterface
{
    private $userService;

    public function __construct(
        UserServiceInterface $userService
    ) {
        $this->userService = $userService;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $values = $request->getParsedBody();
        
        $createUser = CreateUser::fromArray($values);
        
        $this->userService->AddUser($createUser);

        return $delegate->process($request);
    }
}

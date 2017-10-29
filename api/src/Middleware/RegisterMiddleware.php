<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Oqq\Broetchen\Command\CreateUser;
use Oqq\Broetchen\Command\SetPassword;
use Oqq\Broetchen\Domain\User\UserId;
use Oqq\Broetchen\Service\UserServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RegisterMiddleware implements MiddlewareInterface
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $values = $request->getParsedBody();

        $values['user_id'] = UserId::generate()->toString();
        
        $createUser = CreateUser::fromArray($values);
        $setPassword = SetPassword::fromArray($values);
        
        $this->userService->addUser($createUser);
        $this->userService->setPassword($setPassword);

        return $delegate->process($request);
    }
}

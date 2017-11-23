<?php

declare(strict_types = 1);

namespace Oqq\Broetchen\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Oqq\Broetchen\Domain\User\Credentials;
use Oqq\Broetchen\Service\UserServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use PSR7Sessions\Storageless\Http\SessionMiddleware;
use PSR7Sessions\Storageless\Session\SessionInterface;
use Zend\Diactoros\Response\EmptyResponse;

final class LoginMiddleware implements MiddlewareInterface
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $values = $request->getParsedBody();

        $credentials = Credentials::fromArray($values);

        try {
            $user = $this->userService->getUserForCredentials($credentials);
        } catch (\Exception $exception) {
            return new EmptyResponse(401);
        }

        if (null !== $user) {
            /** @var SessionInterface $session */
            $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
            $session->set('user_id', $user->userId()->toString());
        }

        return $delegate->process($request);
    }
}

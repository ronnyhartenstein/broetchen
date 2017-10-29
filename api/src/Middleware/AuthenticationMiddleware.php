<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Oqq\Broetchen\Domain\User\UserId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use PSR7Sessions\Storageless\Http\SessionMiddleware;
use PSR7Sessions\Storageless\Session\SessionInterface;

final class AuthenticationMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $userId = $this->getUserIdFromRequest($request);

        if (null === $userId) {
            return $delegate->process($request);
        }

        return $delegate->process($request->withAttribute('user_id', $userId));
    }

    private function getUserIdFromRequest(ServerRequestInterface $request): ?UserId
    {
        $session = $this->getSession($request);

        $userIdString = $session->get('user_id', null);

        return null === $userIdString ? null : UserId::fromString($userIdString);
    }

    private function getSession(ServerRequestInterface $request): SessionInterface
    {
        return $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
    }
}

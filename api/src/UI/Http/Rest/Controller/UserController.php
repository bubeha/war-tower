<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller;

use App\Shared\Infrastructure\ReadModel\User\GetCurrentUser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Response\OpenApi;

final class UserController
{
    #[Route(path: 'users')]
    public function __invoke(GetCurrentUser $repository): OpenApi
    {
        $user = $repository->getCurrentUser();

        if ($user) {
            return OpenApi::fromPayload($user, Response::HTTP_OK);
        }

        return OpenApi::fromPayload('Couldn\'t find user', Response::HTTP_NOT_FOUND);
    }
}

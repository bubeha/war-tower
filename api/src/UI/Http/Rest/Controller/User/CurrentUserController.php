<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\User;

use App\Shared\Domain\Repository\User\GetCurrentUser;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Response\OpenApi;

final class CurrentUserController
{
    #[Route(path: 'users', name: 'current_user', methods: ['GET'])]
    #[OA\Response(
        ref: '#/components/responses/currentUser',
        response: 200,
        description: 'Return Current User',
    )]
    #[OA\Response(
        response: 404,
        description: 'Not found',
    )]
    #[OA\Tag(name: 'users')]
    public function __invoke(GetCurrentUser $repository): OpenApi
    {
        $user = $repository->getCurrentUser();

        if ($user) {
            return OpenApi::fromPayload($user, Response::HTTP_OK);
        }

        return OpenApi::fromPayload('Couldn\'t find user', Response::HTTP_NOT_FOUND);
    }
}

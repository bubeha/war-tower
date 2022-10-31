<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Recipe;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Response\OpenApi;

final class GetAllAction
{
    #[Route(path: '/recipes', methods: ['GET', 'HEAD'])]
    public function __invoke(): OpenApi
    {
        return OpenApi::empty(Response::HTTP_OK);
    }
}

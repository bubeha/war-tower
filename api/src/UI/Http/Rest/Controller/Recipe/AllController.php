<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Recipe;

use App\Game\Domain\Repository\Recipe\FindAll;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Response\OpenApi;

final class AllController
{
    #[Route('/recipes', name: 'all_recipes', methods: ['GET'])]
    public function __invoke(FindAll $repository): OpenApi
    {
        return OpenApi::empty(200);
    }
}

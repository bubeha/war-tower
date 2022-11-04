<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Recipe;

use App\Shared\Domain\Entity\Recipe\Recipe;
use App\Shared\Infrastructure\ReadModel\Recipe\RecipeRepository;
use App\Shared\Infrastructure\ReadModel\Recipe\RecipeView;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Response\OpenApi;

use function array_map;

final class GetAllAction
{
    public function __construct(private readonly RecipeRepository $repository)
    {
    }

    #[Route(path: '/recipes', methods: ['GET', 'HEAD'])]
    public function __invoke(): OpenApi
    {
        $data = $this->repository->findAll();

        return OpenApi::fromPayload(
            array_map(
                static fn (Recipe $recipe) => RecipeView::create($recipe->getId(), $recipe->getProduct(), $recipe->getProducts()),
                $data
            ),
            Response::HTTP_OK
        );
    }
}

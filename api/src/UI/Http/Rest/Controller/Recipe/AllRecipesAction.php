<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Recipe;

use App\Shared\Domain\Repository\Recipe\RecipeRepository;
use App\Shared\Infrastructure\Serializer\RecipeNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use UI\Http\Rest\Response\OpenApi;

final class AllRecipesAction
{
    private readonly Serializer $serializer;

    public function __construct(private readonly RecipeRepository $repository)
    {
        $this->serializer = new Serializer([new RecipeNormalizer()]);
    }

    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    #[Route(path: '/recipes', methods: ['GET', 'HEAD'])]
    public function __invoke(): OpenApi
    {
        return OpenApi::fromPayload(
            $this->serializer->normalize(
                $this->repository->all(),
            ),
            Response::HTTP_OK,
        );
    }
}

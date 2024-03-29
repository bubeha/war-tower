<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Recipe;

use App\Game\Domain\Repository\Recipe\FindAll;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use UI\Http\Rest\Response\OpenApi;

final class AllController
{
    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    #[Route('/recipes', name: 'all_recipes', methods: ['GET'])]
    #[OA\Response(
        ref: '#/components/responses/recipes',
        response: 200,
    )]
    #[OA\Tag(name: 'recipes')]
    public function __invoke(FindAll $repository, NormalizerInterface $normalizer): OpenApi
    {
        $output = $normalizer->normalize($repository->all());

        return OpenApi::fromPayload($output, 200);
    }
}

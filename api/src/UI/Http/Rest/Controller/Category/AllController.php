<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Category;

use App\Shared\Infrastructure\Persistence\ReadModel\Category\GetAllCategories;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use UI\Http\Rest\Response\OpenApi;

final class AllController
{
    #[Route('/categories', name: 'all_categories', methods: ['GET'])]
    #[OA\Response(
        ref: "#/components/responses/categories",
        response: 200,
        description: 'Returns all categories'
    )]
    #[OA\Tag(name: 'categories')]
    public function __invoke(GetAllCategories $repository, SerializerInterface $serializer): OpenApi
    {
        $output = $serializer->serialize($repository->all(), JsonEncoder::FORMAT, [
            AbstractNormalizer::ATTRIBUTES => [
                'id',
                'name',
            ],
        ]);

        return OpenApi::fromPayload($output, 200, [], true);
    }
}

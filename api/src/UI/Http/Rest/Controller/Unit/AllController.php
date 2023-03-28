<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Unit;

use App\Game\Domain\Repository\Unit\FindAll;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use UI\Http\Rest\Response\OpenApi;

final class AllController
{
    #[Route('/units', name: 'all_units', methods: ['GET'])]
    #[OA\Response(
        ref: '#/components/responses/units',
        response: 200,
    )]
    #[OA\Tag(name: 'units')]
    public function __invoke(FindAll $repository, SerializerInterface $serializer): OpenApi
    {
        $output = $serializer->serialize($repository->all(), JsonEncoder::FORMAT);

        return OpenApi::fromPayload($output, 200, [], true);
    }
}

<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Unit;

use App\Game\Domain\Repository\Unit\FindAll;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use UI\Http\Rest\Response\OpenApi;

final class AllController
{
    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    #[Route('/units', name: 'all_units', methods: ['GET'])]
    #[OA\Response(
        ref: '#/components/responses/units',
        response: 200,
    )]
    #[OA\Tag(name: 'units')]
    public function __invoke(FindAll $repository, NormalizerInterface $serializer): OpenApi
    {
        $output = $serializer->normalize($repository->all());

        return OpenApi::fromPayload($output, 200);
    }
}

<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller;

use App\Shared\Domain\Entity\Category;
use App\Shared\Domain\Entity\Unit\Cost;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Domain\ValueObject\Slug;
use App\Shared\Infrastructure\Persistence\ReadModel\Unit\GetAllUnits;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use UI\Http\Rest\Response\OpenApi;

final class AllUnitsController
{
    #[Route('/units', name: 'all_units')]
    public function __invoke(GetAllUnits $repository, SerializerInterface $serializer): OpenApi
    {
        $output = $serializer->serialize($repository->all(), JsonEncoder::FORMAT, [
            AbstractNormalizer::ATTRIBUTES => [
                'id',
                'category',
                'name',
                'slug',
                'createdAt',
                'cost',
            ],
            AbstractNormalizer::CALLBACKS => [
                'id' => static fn (Uuid $value): string => $value->toString(),
                'category' => static fn (Category $category): string => $category->getName(),
                'slug' => static fn (Slug $value): string => $value->toString(),
                'createdAt' => static fn (DateTime $value): string => $value->toString(),
                'cost' => static fn (null|Cost $cost): float => $cost ? ($cost->getCost() / 100) : 0.0,
            ],
        ]);

        return OpenApi::fromPayload($output, 200, [], true);
    }
}

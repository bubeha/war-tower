<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Unit;

use App\Shared\Domain\Entity\Category;
use App\Shared\Domain\Entity\Unit\Cost;
use App\Shared\Domain\Repository\Unit\FindAll;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Domain\ValueObject\Slug;
use Doctrine\Common\Collections\Collection;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
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
        $output = $serializer->serialize($repository->all(), JsonEncoder::FORMAT, [
            AbstractNormalizer::ATTRIBUTES => [
                'id',
                'category',
                'name',
                'slug',
                'createdAt',
                'cost',
                'characteristics',
            ],
            AbstractNormalizer::CALLBACKS => [
                'id' => static fn (Uuid $value): string => $value->toString(),
                'category' => static fn (Category $category): string => $category->getName(),
                'slug' => static fn (Slug $value): string => $value->toString(),
                'createdAt' => static fn (DateTime $value): string => $value->toString(),
                'cost' => static fn (null|Cost $cost): float => $cost ? ($cost->getCost() / 100) : 0.0,
                'characteristics' => static function (Collection $collection) {
                    $result = [];
                    /** @var list<\App\Shared\Domain\Entity\Unit\Characteristic> $items */
                    $items = $collection->getValues();

                    foreach ($items as $item) {
                        $characteristic = $item->getCharacteristic();

                        $result[] = [
                            'key' => $characteristic->getId(),
                            'name' => $characteristic->getName(),
                            'value' => $item->getValue(),
                        ];
                    }

                    return $result;
                },
            ],
        ]);

        return OpenApi::fromPayload($output, 200, [], true);
    }
}

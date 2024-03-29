<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Normalizer;

use App\Game\Domain\Entity\Recipe\Item;
use App\Game\Domain\Entity\Recipe\Recipe;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class RecipeNormalizer implements NormalizerInterface
{
    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        /** @var Recipe $object */
        $goal = $object->getUnit();

        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'goal' => [
                'id' => $goal->getId()->toString(),
                'name' => $goal->getName(),
                'key' => $goal->getSlug()->toString(),
                'cost' => $goal->getCost()?->getPrice()->getOriginal(),
            ],
            'requirements' => $object->getItems()->map(static function (Item $item) {
                $unit = $item->getUnit();

                return [
                    'id' => $item->getId()->toString(),
                    'name' => $unit->getName(),
                    'key' => $unit->getSlug()->toString(),
                    'cost' => $unit->getCost()?->getPrice()->getOriginal(),
                    'quantity' => $item->getQuantity(),
                ];
            })->toArray(),
        ];
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Recipe;
    }
}

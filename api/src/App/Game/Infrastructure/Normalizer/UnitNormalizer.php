<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Normalizer;

use App\Game\Domain\Entity\Unit\Unit;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UnitNormalizer implements NormalizerInterface
{
    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        /** @var Unit $object */
        $result = [
            'id' => $object->getId()->toString(),
            'category' => $object->getCategory()->getName(),
            'name' => $object->getName(),
            'key' => $object->getSlug()->toString(),
            'cost' => ((int)$object->getCost()?->getCost()) / 100,
        ];

        foreach ($object->getCharacteristics() as $characteristic) {
            /** @var \App\Game\Domain\Entity\Unit\Characteristic $characteristic */
            $result[$characteristic->getCharacteristic()->getId()] = $characteristic->getValue();
        }

        return $result;
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $data instanceof Unit;
    }
}

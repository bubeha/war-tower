<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Serializer;

use App\Shared\Domain\Entity\Product\Product;
use ArrayObject;
use Symfony\Component\Serializer\Normalizer\CustomNormalizer;

final class ProductNormalizer extends CustomNormalizer
{
    public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|ArrayObject|null
    {
        /**
         * @noRector
         * @var Product $object
         */
        return [
            'id' => $object->getId(),
            'name' => $object->getDetail()->getName(),
            'category' => $object->getCategory()->getName(),
        ];
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $data instanceof Product;
    }
}

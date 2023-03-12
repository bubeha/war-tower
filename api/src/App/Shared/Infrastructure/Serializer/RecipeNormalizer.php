<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Serializer;

use App\Shared\Domain\Entity\Recipe\Recipe;
use ArrayObject;
use Exception;
use Symfony\Component\Serializer\Normalizer\CustomNormalizer;

final class RecipeNormalizer extends CustomNormalizer
{
    /**
     * @throws Exception
     */
    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|ArrayObject|null
    {
        /**
         * @noRector
         */
        $required = [];

        foreach ($object->getItems() as $item) {
            $product = $item->getProduct();
            $required[] = [
                'id' => $item->getId(),
                'name' => $product->getDetail()->getName(),
                'category' => $product->getCategory()->getName(),
                'quantity' => $item->getQuantity(),
            ];
        }
        $product = $object->getProduct();

        return [
            'id' => $object->getId(),
            'target' => [
                'id' => $product->getId(),
                'product' => $product->getDetail()->getName(),
                'category' => $product->getCategory()->getName(),
            ],
            'required' => $required,
        ];
    }

    public function supportsNormalization(mixed $data, ?string $format = null): bool
    {
        return $data instanceof Recipe;
    }
}

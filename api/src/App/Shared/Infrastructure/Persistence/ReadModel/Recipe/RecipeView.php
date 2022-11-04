<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Recipe;

use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Domain\ValueObject\Id\Uuid;
use JsonSerializable;

final class RecipeView implements JsonSerializable
{
    /**
     * @param iterable<\App\Shared\Domain\Entity\Recipe\Item> $products
     */
    public function __construct(private readonly Uuid $id, private readonly Product $productCategory, private readonly iterable $products)
    {
    }

    public function jsonSerialize(): array
    {
        $required = [];

        foreach ($this->products as $value) {
            $required[] = ProductView::create(
                $value->getId(),
                $value->getProduct()->getDetail(),
                $value->getProduct()->getCategory(),
                $value->getQuantity(),
            );
        }

        return [
            'id' => $this->id,
            'target' => [
                'id' => $this->productCategory->getId(),
                'product' => $this->productCategory->getDetail()->getName(),
                'category' => $this->productCategory->getCategory()->getName(),
            ],
            'required' => $required,
        ];
    }

    /**
     * @param iterable<\App\Shared\Domain\Entity\Recipe\Item> $products
     */
    public static function create(Uuid $id, Product $productCategory, iterable $products): self
    {
        return new self($id, $productCategory, $products);
    }
}

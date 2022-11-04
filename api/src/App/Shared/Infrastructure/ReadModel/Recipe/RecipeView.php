<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ReadModel\Recipe;

use App\Shared\Domain\Entity\ProductCategory;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\ReadModel\Product\ProductView;
use JsonSerializable;

final class RecipeView implements JsonSerializable
{
    /**
     * @param iterable<\App\Shared\Domain\Entity\RecipeProduct> $products
     */
    public function __construct(private readonly Uuid $id, private readonly ProductCategory $productCategory, private readonly iterable $products)
    {
    }

    public function jsonSerialize(): array
    {
        $required = [];

        foreach ($this->products as $value) {
            $required[] = ProductView::create(
                $value->getId(),
                $value->getProduct()->getProduct(),
                $value->getProduct()->getCategory(),
                $value->getQuantity()
            );
        }

        return [
            'id' => $this->id,
            'target' => [
                'id' => $this->productCategory->getId(),
                'product' => $this->productCategory->getProduct()->getName(),
                'category' => $this->productCategory->getCategory()->getName(),
            ],
            'required' => $required,
        ];
    }

    /**
     * @param iterable<\App\Shared\Domain\Entity\RecipeProduct> $products
     * @return static
     */
    public static function create(Uuid $id, ProductCategory $productCategory, iterable $products): self
    {
        return new self($id, $productCategory, $products);
    }
}

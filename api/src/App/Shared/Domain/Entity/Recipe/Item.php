<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\Recipe;

use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;

/**
 * @final
 */
class Item
{
    public function __construct(
        /** @noRector ReadOnlyPropertyRector */
        private Uuid $id,
        private Recipe $recipe,
        private Product $product,
        private int $quantity,
        private readonly DateTime $createdAt
    )
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, Recipe $recipe, Product $product, int $quantity, ?DateTime $createdAt = null): self
    {
        return new self($id, $recipe, $product, $quantity, $createdAt ?? DateTime::now());
    }

    public function setRecipe(Recipe $recipe): void
    {
        $this->recipe = $recipe;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}

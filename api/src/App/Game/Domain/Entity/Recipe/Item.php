<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity\Recipe;

use App\Game\Domain\Entity\Unit\Unit;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;

/**
 * @final
 */
class Item
{
    public function __construct(
        private readonly Uuid $id,
        private readonly Recipe $recipe,
        private readonly Unit $unit,
        private int $quantity,
        private readonly DateTime $createdAt,
    ) {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, Recipe $recipe, Unit $unit, int $quantity, ?DateTime $createdAt = null): self
    {
        return new self(
            $id,
            $recipe,
            $unit,
            $quantity,
            $createdAt ?? DateTime::now(),
        );
    }

    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}

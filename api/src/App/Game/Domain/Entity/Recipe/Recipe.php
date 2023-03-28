<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity\Recipe;

use App\Game\Domain\Entity\Unit\Unit;
use App\Shared\Domain\ValueObject\DateTime;

/**
 * @final
 */
class Recipe
{
    public function __construct(
        private readonly string $id,
        private string $name,
        private Unit $unit,
        private readonly DateTime $createdAt,
    ) {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(string $id, string $name, Unit $unit, ?DateTime $createdAt = null): self
    {
        return new self(
            $id,
            $name,
            $unit,
            $createdAt ?? DateTime::now(),
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setUnit(Unit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
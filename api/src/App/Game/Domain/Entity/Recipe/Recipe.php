<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity\Recipe;

use App\Game\Domain\Entity\Unit\Unit;
use App\Shared\Domain\ValueObject\DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
        /** @var \Doctrine\Common\Collections\Collection<int, \App\Game\Domain\Entity\Recipe\Item> $items */
        private ?Collection $items = new ArrayCollection(),
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

    /**
     * @return \Doctrine\Common\Collections\Collection<int, \App\Game\Domain\Entity\Recipe\Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection<int, \App\Game\Domain\Entity\Recipe\Item> $items
     */
    public function setItems(Collection $items): static
    {
        $this->items = $items;

        return $this;
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

<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity\Unit;

use App\Game\Domain\Entity\Category;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Domain\ValueObject\Slug;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @final
 */
class Unit
{
    public function __construct(
        private readonly Uuid $id,
        private readonly Category $category,
        private Slug $slug,
        private string $name,
        private readonly DateTime $createdAt,
        private ?Cost $cost = null,
        /** @var Collection<int, \App\Game\Domain\Entity\Unit\Unit> $characteristics */
        private ?Collection $characteristics = new ArrayCollection(),
    )
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, Category $category, Slug $slug, string $name, ?DateTime $createdAt = null): self
    {
        return new self($id, $category, $slug, $name, $createdAt ?? DateTime::now());
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setSlug(Slug $slug): void
    {
        $this->slug = $slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCost(): null|Cost
    {
        return $this->cost;
    }

    public function setCost(Cost $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection<int, \App\Game\Domain\Entity\Unit\Unit>
     */
    public function getCharacteristics(): Collection
    {
        return $this->characteristics;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection<int, \App\Game\Domain\Entity\Unit\Unit> $characteristics
     */
    public function setCharacteristics(Collection $characteristics): void
    {
        $this->characteristics = $characteristics;
    }
}

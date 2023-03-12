<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\Unit;

use App\Shared\Domain\Entity\Category;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Domain\ValueObject\Slug;

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
    ) {
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
}
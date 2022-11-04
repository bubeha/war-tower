<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\Product;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;

/**
 * @final
 */
class Product
{
    public function __construct(private Uuid $id, private readonly Detail $detail, private readonly Category $category, private readonly DateTime $createdAt)
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, Detail $product, Category $category, ?DateTime $createdAt = null): self
    {
        return new self($id, $product, $category, $createdAt ?? DateTime::now());
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getDetail(): Detail
    {
        return $this->detail;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}

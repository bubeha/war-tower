<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;

final class ProductCategory
{
    public function __construct(private readonly Uuid $id, private readonly Product $product, private readonly Category $category, private readonly DateTime $createdAt)
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, Product $product, Category $category): self
    {
        return new self($id, $product, $category, DateTime::now());
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
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

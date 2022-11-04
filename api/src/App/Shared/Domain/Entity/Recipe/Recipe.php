<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\Recipe;

use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @final
 */
class Recipe
{
    /**
     * @var Collection<int,\App\Shared\Domain\Entity\Recipe\Item>
     */
    private Collection $products;

    public function __construct(private Uuid $id, private Product $product, private readonly DateTime $createdAt)
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, Product $product, ?DateTime $createdAt = null): self
    {
        return new self($id, $product, $createdAt ?? DateTime::now());
    }

    /**
     * @return \Doctrine\Common\Collections\Collection<int,\App\Shared\Domain\Entity\Recipe\Item>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}

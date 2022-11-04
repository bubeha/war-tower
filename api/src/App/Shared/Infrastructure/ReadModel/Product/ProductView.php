<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ReadModel\Product;

use App\Shared\Domain\Entity\Product\Category;
use App\Shared\Domain\Entity\Product\Detail;
use App\Shared\Domain\ValueObject\Uuid;
use JsonSerializable;

final class ProductView implements JsonSerializable
{
    public function __construct(private readonly Uuid $id, private readonly Detail $product, private readonly Category $category, private readonly int $quantity)
    {
    }

    public static function create(Uuid $id, Detail $product, Category $category, int $quantity): self
    {
        return new self($id, $product, $category, $quantity);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'product' => $this->product->getName(),
            'category' => $this->category->getName(),
            'quantity' => $this->quantity,
        ];
    }
}

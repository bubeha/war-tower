<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Product;

use App\Shared\Domain\Entity\Product\Category;
use App\Shared\Domain\Entity\Product\Detail;
use App\Shared\Domain\ValueObject\Id\Uuid;
use JsonSerializable;

final class ProductView implements JsonSerializable
{
    public function __construct(private readonly Uuid $id, private readonly Detail $detail, private readonly Category $category)
    {
    }

    public static function create(Uuid $id, Detail $detail, Category $category): self
    {
        return new self($id, $detail, $category);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->detail->getName(),
            'category' => $this->category->getName(),
        ];
    }
}

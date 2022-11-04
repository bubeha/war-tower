<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository\Product;

use App\Shared\Domain\Entity\Product\Product;
use LogicException;

interface ProductRepository
{
    /**
     * @return list<\App\Shared\Domain\Entity\Product\Product>
     */
    public function all(): array;

    /** @throws LogicException */
    public function getProductForFixture(string $detail, string $category): Product;
}

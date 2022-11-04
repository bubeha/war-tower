<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository\Product;

interface ProductRepository
{
    /**
     * @return list<\App\Shared\Domain\Entity\Product\Product>
     */
    public function all(): array;
}

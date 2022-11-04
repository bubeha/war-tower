<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Product;

use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Domain\Repository\Product\ProductRepository;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<Product>
 */
final class PostgresqlProductRepository extends PostgresRepository implements ProductRepository
{
    public function all(): array
    {
        return $this->repository->findAll();
    }

    protected function getEntityClass(): string
    {
        return Product::class;
    }
}

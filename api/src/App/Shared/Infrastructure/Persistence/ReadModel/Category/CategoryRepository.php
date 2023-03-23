<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Category;

use App\Shared\Domain\Entity\Category;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<\App\Shared\Domain\Entity\Category>
 */
final class CategoryRepository extends PostgresRepository implements GetAllCategories
{
    public function all(): array
    {
        /** @var list<\App\Shared\Domain\Entity\Category> $result */
        $result = $this->repository->createQueryBuilder('u')
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }

    protected function getEntityClass(): string
    {
        return Category::class;
    }
}

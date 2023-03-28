<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\ReadModel\Category;

use App\Game\Domain\Entity\Category;
use App\Game\Domain\Repository\Category\FindAll;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<\App\Game\Domain\Entity\Category>
 */
final class CategoryRepository extends PostgresRepository implements FindAll
{
    public function all(): array
    {
        /** @var list<Category> $result */
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

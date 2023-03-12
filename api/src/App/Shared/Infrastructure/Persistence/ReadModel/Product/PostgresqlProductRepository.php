<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Product;

use App\Shared\Domain\Entity\Category;
use App\Shared\Domain\Entity\Unit\Detail;
use App\Shared\Domain\Entity\Unit\Unit;
use App\Shared\Domain\Repository\Product\ProductRepository;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @template-extends PostgresRepository<Unit>
 */
final class PostgresqlProductRepository extends PostgresRepository implements ProductRepository
{
    public function all(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getProductForFixture(string $detail, string $category): Unit
    {
        $query = $this->repository->createQueryBuilder('p')
            ->innerJoin(Detail::class, 'd', Join::WITH, 'p.detail = d.id')
            ->innerJoin(Category::class, 'c', Join::WITH, 'p.category = c.id')
            ->where('d.name = :name AND c.name = :category')
            ->setParameters([
                'name' => $detail,
                'category' => $category,
            ])
        ;

        return $this->oneOrException($query);
    }

    protected function getEntityClass(): string
    {
        return Unit::class;
    }
}

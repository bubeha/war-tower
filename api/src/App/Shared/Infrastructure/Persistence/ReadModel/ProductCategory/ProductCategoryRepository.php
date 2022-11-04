<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\ProductCategory;

use App\Shared\Domain\Entity\Product\Category;
use App\Shared\Domain\Entity\Product\Detail;
use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use LogicException;

final class ProductCategoryRepository extends PostgresRepository
{
    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @psalm-param AbstractQuery::HYDRATE_* $hydration
     */
    public function getProduct(int $hydration = AbstractQuery::HYDRATE_OBJECT): Product
    {
        /** @var Product|null $model */
        $model = $this->repository->createQueryBuilder('p')
            ->innerJoin(Detail::class, 'd', Join::WITH, 'p.detail = d.id')
            ->innerJoin(Category::class, 'c', Join::WITH, 'p.category = c.id')
            ->where('d.name = :name AND c.name = :category')
            ->setParameters([
                'name' => 'Weapon',
                'category' => 'Raw',
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult($hydration)
        ;

        if (null === $model) {
            throw new LogicException('Not Found Model');
        }

        return $model;
    }

    protected function getEntityClass(): string
    {
        return Product::class;
    }
}

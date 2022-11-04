<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ReadModel\ProductCategory;

use App\Shared\Domain\Entity\Product\Category;
use App\Shared\Domain\Entity\Product\Detail;
use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use LogicException;

final class ProductCategoryRepository extends PostgresRepository
{
    private readonly EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->repository = $this->entityManager->getRepository(Product::class);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @psalm-param AbstractQuery::HYDRATE_* $hydration
     */
    public function getProductFor(int $hydration = AbstractQuery::HYDRATE_OBJECT): Product
    {
        /** @var Product|null $model */
        $model = $this->repository->createQueryBuilder('pc')
            ->innerJoin(Detail::class, 'p', Join::WITH, 'pc.product = p.id')
            ->innerJoin(Category::class, 'c', Join::WITH, 'pc.category = c.id')
            ->where('p.name = :product AND c.name = :category')
            ->setParameters([
                'product' => 'Weapon',
                'category' => 'Raw',
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult($hydration)
        ;

        if ($model instanceof Product) {
            return $model;
        }

        throw new LogicException('Not Found Model');
    }
}

<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Repository;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use LogicException;

/**
 * @template T as object
 */
abstract class PostgresRepository
{
    /** @var \Doctrine\ORM\EntityRepository<T> */
    protected EntityRepository $repository;

    public function __construct(protected EntityManagerInterface $entityManager)
    {
        $this->repository = $this->entityManager->getRepository($this->getEntityClass());
    }

    /** @return class-string<T> */
    abstract protected function getEntityClass(): string;

    /**
     * @psalm-param AbstractQuery::HYDRATE_* $hydration
     * @return T
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function oneOrException(QueryBuilder $builder, int $hydration = AbstractQuery::HYDRATE_OBJECT)
    {
        /** @var T|null $entry */
        $entry = $builder
            ->getQuery()
            ->getOneOrNullResult($hydration)
        ;

        if (null === $entry) {
            // todo replace
            throw new LogicException();
        }

        return $entry;
    }

    protected function store(object $entry): void
    {
        $this->entityManager->persist($entry);
        $this->entityManager->flush();
    }
}

<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ReadModel\User;

use App\Shared\Domain\Entity\User;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @template-extends PostgresRepository<User>
 */
final class UserRepository extends PostgresRepository implements GetCurrentUser
{
    private readonly EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->repository = $this->entityManager->getRepository(User::class);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @psalm-suppress MixedInferredReturnType
     * @psalm-suppress MixedReturnStatement
     */
    public function getCurrentUser(): null|User
    {
        return $this->repository->createQueryBuilder('u')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

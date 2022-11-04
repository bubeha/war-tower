<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\User;

use App\Shared\Domain\Entity\User;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @template-extends PostgresRepository<User>
 */
final class UserRepository extends PostgresRepository implements GetCurrentUser
{
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

    protected function getEntityClass(): string
    {
        return User::class;
    }
}

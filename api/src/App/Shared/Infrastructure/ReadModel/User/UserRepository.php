<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ReadModel\User;

use App\Shared\Domain\Entity\User;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @template-extends PostgresRepository<User>
 */
final class UserRepository extends PostgresRepository implements GetCurrentUser
{
    private EntityRepository $repository;

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCurrentUser(): null|User
    {
        /** @var User */
        return $this->repository->createQueryBuilder('u')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    protected function setEntityManager(): void
    {
        $this->repository = $this->entityManager->getRepository(User::class);
    }
}

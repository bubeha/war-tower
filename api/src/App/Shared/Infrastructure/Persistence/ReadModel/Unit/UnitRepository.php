<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Unit;

use App\Shared\Domain\Entity\Unit\Unit;
use App\Shared\Domain\Repository\Unit\FindAll;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<\App\Shared\Domain\Entity\Unit\Unit>
 */
final class UnitRepository extends PostgresRepository implements FindAll
{
    public function all(): array
    {
        /** @var list<Unit> $result */
        $result = $this->repository->createQueryBuilder('u')
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }

    protected function getEntityClass(): string
    {
        return Unit::class;
    }
}

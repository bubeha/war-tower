<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Unit;

use App\Shared\Domain\Entity\Unit\Unit;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<\App\Shared\Domain\Entity\Unit\Unit>
 */
class UnitRepository extends PostgresRepository implements GetAllUnits
{

    protected function getEntityClass(): string
    {
        return Unit::class;
    }

    public function all(): array
    {
        return $this->repository->createQueryBuilder('u')
            ->getQuery()
            ->getResult();
    }
}

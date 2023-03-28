<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\ReadModel\Unit;

use App\Game\Domain\Entity\Unit\Unit;
use App\Game\Domain\Repository\Unit\FindAll;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<\App\Game\Domain\Entity\Unit\Unit>
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

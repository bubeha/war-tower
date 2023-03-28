<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\ReadModel\Characteristic;

use App\Game\Domain\Entity\Characteristic;
use App\Game\Domain\Repository\Characteristic\FindAll;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<\App\Game\Domain\Entity\Characteristic>
 */
final class CharacteristicRepository extends PostgresRepository implements FindAll
{
    public function all(): array
    {
        /** @var list<Characteristic> $result */
        $result = $this->repository->createQueryBuilder('c')
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }

    protected function getEntityClass(): string
    {
        return Characteristic::class;
    }
}

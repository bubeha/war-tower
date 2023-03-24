<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Characteristic;

use App\Shared\Domain\Entity\Characteristic;
use App\Shared\Domain\Repository\Characteristic\FindAll;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<\App\Shared\Domain\Entity\Characteristic>
 */
final class CharacteristicRepository extends PostgresRepository implements FindAll
{
    public function all(): array
    {
        /** @var list<\App\Shared\Domain\Entity\Characteristic> $result */
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

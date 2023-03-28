<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\ReadModel\Recipe;

use App\Game\Domain\Entity\Characteristic;
use App\Game\Domain\Entity\Recipe\Recipe;
use App\Game\Domain\Repository\Recipe\FindAll;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<\App\Game\Domain\Entity\Recipe\Recipe>
 */
final class RecipeRepository extends PostgresRepository implements FindAll
{
    public function all(): array
    {
        /** @var list<Recipe> $result */
        $result = $this->repository->createQueryBuilder('r')
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }

    protected function getEntityClass(): string
    {
        return Recipe::class;
    }
}

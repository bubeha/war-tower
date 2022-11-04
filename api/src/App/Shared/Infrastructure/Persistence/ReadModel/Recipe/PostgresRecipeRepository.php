<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Recipe;

use App\Shared\Domain\Entity\Recipe\Recipe;
use App\Shared\Domain\Repository\Recipe\RecipeRepository;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;

/**
 * @template-extends PostgresRepository<Recipe>
 */
final class PostgresRecipeRepository extends PostgresRepository implements RecipeRepository
{
    public function all(): array
    {
        return $this->repository->findAll();
    }

    protected function getEntityClass(): string
    {
        return Recipe::class;
    }
}

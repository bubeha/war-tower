<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository\Recipe;

interface RecipeRepository
{
    /**
     * @return list<\App\Shared\Domain\Entity\Recipe\Recipe>
     */
    public function all(): array;
}

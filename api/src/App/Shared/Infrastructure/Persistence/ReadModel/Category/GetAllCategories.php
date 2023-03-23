<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Category;

interface GetAllCategories
{
    /**
     * @return array<int,\App\Shared\Domain\Entity\Category>
     */
    public function all(): array;
}

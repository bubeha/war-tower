<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\ReadModel\Unit;

interface GetAllUnits
{
    /**
     * @return list<\App\Shared\Domain\Entity\Unit\Unit>
     */
    public function all(): array;
}

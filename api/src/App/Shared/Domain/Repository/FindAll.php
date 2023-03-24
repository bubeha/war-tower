<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository;

/**
 * @template T
 */
interface FindAll
{
    /**
     * @return array<int,T>
     */
    public function all(): array;
}

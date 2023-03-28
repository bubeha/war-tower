<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository;

/**
 * @template T
 */
interface FindAll
{
    /**
     * @return list<T>
     */
    public function all(): array;
}

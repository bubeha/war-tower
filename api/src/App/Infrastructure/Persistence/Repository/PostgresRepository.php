<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @template T
 */
abstract class PostgresRepository
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
        $this->setEntityManager();
    }

    abstract protected function setEntityManager(): void;
}

<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Repository;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @template T
 */
abstract class PostgresRepository
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    protected function store(object $entry): void
    {
        $this->entityManager->persist($entry);
        $this->entityManager->flush();
    }
}

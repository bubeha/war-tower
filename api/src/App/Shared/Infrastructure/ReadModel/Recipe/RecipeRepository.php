<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ReadModel\Recipe;

use App\Shared\Domain\Entity\Recipe\Recipe;
use App\Shared\Infrastructure\Persistence\Repository\PostgresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class RecipeRepository extends PostgresRepository
{
    private readonly EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->repository = $this->entityManager->getRepository(Recipe::class);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}

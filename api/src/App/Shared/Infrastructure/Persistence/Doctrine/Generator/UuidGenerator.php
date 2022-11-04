<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Generator;

use App\Shared\Domain\ValueObject\Id\Uuid;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AbstractIdGenerator;

final class UuidGenerator extends AbstractIdGenerator
{
    public function generate(EntityManagerInterface $em, $entity): Uuid
    {
        return Uuid::generate();
    }
}

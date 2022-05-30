<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[Entity(), Table(name: 'users')]
final class User
{
    #[Id, Column(type: 'uuid', unique: true), GeneratedValue(strategy: 'CUSTOM'), CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface $id;

    public function __construct(UuidInterface $id = null)
    {
        if (null === $id) {
            $this->id = Uuid::uuid4();
            return;
        }

        $this->id = $id;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}

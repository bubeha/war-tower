<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\ValueObject\Money;
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

    #[Id, Column(type: 'integer')]
    private Money $money;

    public function __construct(UuidInterface $id, Money $money)
    {
        $this->id = $id;
        $this->money = $money;
    }

    public static function create(Money $money, UuidInterface $id = null): self
    {
        return new self($id ?? Uuid::uuid4(), $money);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}

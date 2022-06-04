<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\DateTime;
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

    #[Column(type: 'integer')]
    private int $money;

    #[Column(type: 'integer')]
    private int $experience;

    #[Column(type: 'datetime_immutable')]
    private ?DateTime $createdAt;

    #[Column(type: 'datetime_immutable')]
    private ?DateTime $updatedAt;

    public function __construct(UuidInterface $id, Money $money, int $experience, ?DateTime $createdAt, ?DateTime $updatedAt)
    {
        $this->id = $id;
        $this->money = $money->getValue();
        $this->experience = $experience;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(Money $money, int $experience = 0): self
    {
        return new self(Uuid::uuid4(), $money, $experience, new DateTime('now'), new DateTime('now'));
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getMoney(): int
    {
        return $this->money;
    }

    public function getExperience(): int
    {
        return $this->experience;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
}

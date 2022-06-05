<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\DateTime;
use App\Domain\ValueObject\Experience;
use App\Domain\ValueObject\Money;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use JsonSerializable;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[Entity(), Table(name: 'users')]
final class User implements JsonSerializable
{
    #[Id, Column(type: 'uuid', unique: true), GeneratedValue(strategy: 'CUSTOM'), CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface $id;

    #[Column(type: 'money')]
    private Money $money;

    #[Column(type: 'experience')]
    private Experience $experience;

    #[Column(type: 'datetime_immutable')]
    private ?DateTime $createdAt;

    #[Column(type: 'datetime_immutable')]
    private ?DateTime $updatedAt;

    public function __construct(UuidInterface $id, Money $money, Experience $experience, ?DateTime $createdAt, ?DateTime $updatedAt)
    {
        $this->id = $id;
        $this->money = $money;
        $this->experience = $experience;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(Money $money, Experience $experience): self
    {
        return new self(Uuid::uuid4(), $money, $experience, new DateTime('now'), new DateTime('now'));
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getExperience(): Experience
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'money' => $this->getMoney()->getOriginal(),
            'experience' => $this->getExperience()->getValue(),
            'created_at' => $this->getCreatedAt()?->format('Y-m-d H:i:s'),
            'updated_at' => $this->getUpdatedAt()?->format('Y-m-d H:i:s'),
        ];
    }
}

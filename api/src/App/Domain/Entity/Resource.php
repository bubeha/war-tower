<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[Entity, Table(name: 'resources')]
final class Resource
{
    #[Id, Column(type: 'uuid', unique: true), GeneratedValue(strategy: 'CUSTOM'), CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface $id;

    #[Column(type: 'string', unique: true)]
    private string $slug;

    #[Column(type: 'string')]
    private string $name;

    #[Column(type: 'datetime_immutable')]
    private ?DateTime $createdAt;

    #[Column(type: 'datetime_immutable')]
    private ?DateTime $updatedAt;

    public function __construct(UuidInterface $id, string $slug, string $name, ?DateTime $createdAt, ?DateTime $updatedAt)
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(string $slug, string $name, ?DateTime $createdAt, ?DateTime $updatedAte): self
    {
        return new self(Uuid::uuid4(), $slug, $name, $createdAt, $updatedAte);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function getUsers(): ?Collection
    {
        return $this->users;
    }
}

<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;

final class Category
{
    public function __construct(private readonly Uuid $id, private string $name, private readonly DateTime $createdAt, private ?DateTime $updatedAt = null)
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, string $name, ?DateTime $createdAt = null): self
    {
        return new self(
            $id,
            $name,
            $createdAt ?? DateTime::now()
        );
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function setName(string $name): void
    {
        $this->name = $name;
        $this->updatedAt = DateTime::now();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
}
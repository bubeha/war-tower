<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity;

use App\Shared\Domain\ValueObject\DateTime;

/**
 * @final
 */
class Category
{
    public function __construct(
        private readonly string $id,
        private string $name,
        private readonly DateTime $createdAt,
    ) {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(string $id, string $name, ?DateTime $createdAt = null): self
    {
        return new self(
            $id,
            $name,
            $createdAt ?? DateTime::now(),
        );
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getId(): string
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
}

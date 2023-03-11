<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\Product;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;

/**
 * @final
 */
class Detail
{
    public function __construct(
        private readonly Uuid $id,
        private string $name,
        private readonly DateTime $createdAt
    ) {
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

    public function setName(string $name): void
    {
        $this->name = $name;
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
}

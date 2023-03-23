<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;

/**
 * @final
 */
class Characteristic
{
    public function __construct(private readonly Uuid $id, private string $name, private readonly DateTime $createdAt)
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $uuid, string $name, ?DateTime $createdAt = null): self
    {
        return new self($uuid, $name, $createdAt ?? DateTime::now());
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}

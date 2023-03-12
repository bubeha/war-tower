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
    private readonly DateTime $createdAt;

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function __construct(private readonly Uuid $id, private string $name, ?DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt ?? DateTime::now();
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

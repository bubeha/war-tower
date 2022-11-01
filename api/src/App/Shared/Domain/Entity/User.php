<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;
use JsonSerializable;

final class User implements JsonSerializable
{
    public function __construct(private readonly Uuid $id, private readonly ?DateTime $createdAt, private readonly ?DateTime $updatedAt = null)
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id): self
    {
        return new self($id, DateTime::now());
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'created_at' => $this->getCreatedAt()?->format('Y-m-d H:i:s'),
            'updated_at' => $this->getUpdatedAt()?->format('Y-m-d H:i:s'),
        ];
    }

    public function getId(): Uuid
    {
        return $this->id;
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

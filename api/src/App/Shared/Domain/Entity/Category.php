<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;

final class Category
{
    /** @var array<\App\Shared\Domain\Entity\Product> */
    private array $products = [];

    public function __construct(private readonly Uuid $id, private string $name, private readonly DateTime $createdAt, private ?DateTime $updatedAt = null)
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, string $name): self
    {
        return new self(
            $id,
            $name,
            DateTime::now()
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

    /**
     * @return array<\App\Shared\Domain\Entity\Category>
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}

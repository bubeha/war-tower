<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final class Slug
{
    public function __construct(private readonly string $slug)
    {
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function toString(): string
    {
        return $this->slug;
    }
}

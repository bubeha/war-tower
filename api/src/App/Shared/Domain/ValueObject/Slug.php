<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class Slug
{
    public function __construct(private readonly string $slug)
    {
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public static function fromString(string $string): self
    {
        return new self($string);
    }

    public function toString(): string
    {
        return $this->slug;
    }
}

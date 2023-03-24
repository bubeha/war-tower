<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final readonly class Slug
{
    public function __construct(private string $slug)
    {
    }

    public static function fromString(string $string): self
    {
        return new self($string);
    }

    /**
     * @param list<string> $args
     */
    public static function fromArray(...$args): self
    {
        return new self(\implode('_', \array_map(static fn (string $value) => \strtolower(\str_replace(' ', '_', $value)), $args)));
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->slug;
    }
}

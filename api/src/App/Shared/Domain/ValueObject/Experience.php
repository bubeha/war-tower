<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class Experience
{
    public function __construct(private readonly int $value)
    {
    }

    public static function create(int $value): self
    {
        return new self($value);
    }

    public static function createDefault(): self
    {
        return self::create(0);
    }

    public function getValue(): int
    {
        return $this->value;
    }
}

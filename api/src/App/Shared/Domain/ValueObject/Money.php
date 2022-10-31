<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class Money
{
    public function __construct(private readonly int $value)
    {
    }

    public static function fromConverted(int $value): self
    {
        return new self($value);
    }

    public static function fromOriginal(int|float $value): self
    {
        return self::fromConverted((int)($value * 100));
    }

    public function getConverted(): int
    {
        return $this->value;
    }

    public function getOriginal(): float
    {
        return (float)($this->value / 100);
    }
}

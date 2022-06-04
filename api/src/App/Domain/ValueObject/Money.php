<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final class Money
{
    public function __construct(private int|float $value)
    {
    }

    public static function fromPayload(int|float $value): self
    {
        return new self($value);
    }
}

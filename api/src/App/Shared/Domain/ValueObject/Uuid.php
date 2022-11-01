<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use InvalidArgumentException;
use JsonSerializable;
use Symfony\Component\Uid\UuidV4;

final class Uuid implements JsonSerializable
{
    public function __construct(private readonly string $value)
    {
        if (false === UuidV4::isValid($this->value)) {
            throw new InvalidArgumentException("Invalid UUID4: {$this->value}");
        }
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public static function generate(): self
    {
        return new self((string)new UuidV4());
    }

    public function equals(self $other): bool
    {
        return $this->toString() === $other->toString();
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->toString();
    }
}

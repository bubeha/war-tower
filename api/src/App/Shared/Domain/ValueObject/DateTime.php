<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\DateTimeException;
use DateTimeImmutable;
use Exception;
use Throwable;

final class DateTime extends DateTimeImmutable
{
    public const FORMAT = 'Y-m-d H:i:s';

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function now(): self
    {
        return self::create();
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(string $value = ''): self
    {
        try {
            return new self($value);
        } catch (Throwable $e) {
            throw new DateTimeException(new Exception($e->getMessage(), (int)$e->getCode(), $e));
        }
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function fromString(string $dateTime): self
    {
        return self::create($dateTime);
    }

    /**
     * @param array<array-key, DateTimeImmutable> $data
     */
    public function __unserialize(array $data): void
    {
        parent::__unserialize($data);
    }

    public function toString(): string
    {
        return $this->format(self::FORMAT);
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\DateTimeException;
use DateTimeImmutable;
use Exception;
use Throwable;

/**
 * @psalm-immutable
 */
final class DateTime extends DateTimeImmutable
{
    public const FORMAT = 'Y-m-d\TH:i:s.uP';

    /**
     * @throws \App\Domain\Exception\DateTimeException
     */
    public static function now(): self
    {
        return self::create();
    }

    /**
     * @throws \App\Domain\Exception\DateTimeException
     */
    public static function fromString(string $dateTime): self
    {
        return self::create($dateTime);
    }

    /**
     * @throws \App\Domain\Exception\DateTimeException
     */
    private static function create(string $value = ''): self
    {
        try {
            return new self($value);
        } catch (Throwable $e) {
            throw new DateTimeException(new Exception($e->getMessage(), (int)$e->getCode(), $e));
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\DateTimeException;
use DateTimeImmutable;
use Exception;
use Throwable;

final class DateTime extends DateTimeImmutable
{
    public const FORMAT = 'Y-m-d\TH:i:s.uP';

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
    public static function fromString(string $dateTime): self
    {
        return self::create($dateTime);
    }

    public function toString(): string
    {
        return $this->format(self::FORMAT);
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
}

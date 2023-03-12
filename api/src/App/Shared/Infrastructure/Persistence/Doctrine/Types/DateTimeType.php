<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Types;

use App\Shared\Domain\Exception\DateTimeException;
use App\Shared\Domain\ValueObject\DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\DBAL\Types\Types;

final class DateTimeType extends DateTimeImmutableType
{
    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): null|string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof DateTime) {
            return $value->format($platform->getDateTimeFormatString());
        }

        if ($value instanceof DateTimeImmutable) {
            return $value->format($platform->getDateTimeFormatString());
        }

        throw ConversionException::conversionFailedInvalidType($value, Types::DATETIME_IMMUTABLE, ['null', DateTime::class]);
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): DateTime
    {
        if ($value instanceof DateTime) {
            return $value;
        }

        try {
            $dateTime = DateTime::fromString((string)$value);
        } catch (DateTimeException) {
            throw ConversionException::conversionFailedFormat($value, Types::DATETIME_IMMUTABLE, $platform->getDateTimeFormatString());
        }

        return $dateTime;
    }
}

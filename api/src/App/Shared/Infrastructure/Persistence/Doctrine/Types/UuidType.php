<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Types;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\GuidType;
use Throwable;

use function is_string;

final class UuidType extends GuidType
{
    public const TYPE = 'uuid';

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof Uuid) {
            return $value;
        }

        if (is_string($value)) {
            try {
                return Uuid::fromString($value);
            } catch (Throwable) {
            }
        }

        throw ConversionException::conversionFailedFormat($value, $this->getName(), 'uuid');
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (!$value instanceof Uuid) {
            throw ConversionException::conversionFailedInvalidType(
                $value,
                $this->getName(),
                ['null', Uuid::class]
            );
        }

        return $value->toString();
    }

    public function getName(): string
    {
        return self::TYPE;
    }
}

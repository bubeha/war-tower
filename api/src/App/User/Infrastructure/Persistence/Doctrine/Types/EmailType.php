<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence\Doctrine\Types;

use App\User\Domain\ValueObject\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;

final class EmailType extends StringType
{
    public const TYPE = 'email';

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (!$value instanceof Email) {
            throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', Email::class]);
        }

        return $value->toString();
    }

    public function getName(): string
    {
        return self::TYPE;
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): null|Email
    {
        if ($value === null || $value instanceof Email) {
            return $value;
        }

        if (\is_string($value)) {
            try {
                return Email::fromString($value);
            } catch (\Throwable) {
            }
        }

        throw ConversionException::conversionFailedFormat(
            $value,
            $this->getName(),
            'email',
        );
    }
}

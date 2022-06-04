<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Types;

use App\Domain\ValueObject\Slug;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;

final class SlugType extends StringType
{
    private const TYPE = 'slug';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value instanceof Slug) {
            throw ConversionException::conversionFailedInvalidType($value, $this->getName(), [Slug::class]);
        }

        return $value->toString();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Slug) {
            return $value;
        }

        return Slug::fromString((string)$value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return self::TYPE;
    }
}

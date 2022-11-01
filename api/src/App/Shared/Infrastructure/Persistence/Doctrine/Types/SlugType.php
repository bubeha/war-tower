<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Types;

use App\Shared\Domain\ValueObject\Slug;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;

final class SlugType extends StringType
{
    private const TYPE = 'slug';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof Slug) {
            throw ConversionException::conversionFailedInvalidType($value, $this->getName(), [Slug::class]);
        }

        return $value->toString();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Slug
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

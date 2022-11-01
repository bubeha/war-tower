<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Types;

use App\Shared\Domain\ValueObject\Experience;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\IntegerType;

use function is_numeric;

final class ExperienceType extends IntegerType
{
    private const TYPE = 'experience';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        if (!$value instanceof Experience) {
            throw ConversionException::conversionFailedInvalidType($value, $this->getName(), [Experience::class]);
        }

        return $value->getValue();
    }

    public function convertToPHPValue($value, $platform): Experience
    {
        if (!is_numeric($value)) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), 'integer');
        }

        return Experience::create((int)$value);
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

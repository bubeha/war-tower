<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Types;

use App\Shared\Domain\ValueObject\Money;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\IntegerType;

final class MoneyType extends IntegerType
{
    private const TYPE = 'money';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        if (!$value instanceof Money) {
            throw ConversionException::conversionFailedInvalidType($value, $this->getName(), [Money::class]);
        }

        return $value->getConverted();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Money
    {
        if (!\is_numeric($value)) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), 'integer');
        }

        return Money::fromConverted((int)$value);
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

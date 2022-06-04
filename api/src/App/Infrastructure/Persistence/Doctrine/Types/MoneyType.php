<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Types;

use App\Domain\ValueObject\Money;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\IntegerType;
use function is_numeric;

final class MoneyType extends IntegerType
{
    private const TYPE = 'money';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!($value instanceof Money)) {
            throw ConversionException::conversionFailedInvalidType($value, $this->getName(), [Money::class]);
        }

        return $value->getConverted();
    }

    public function convertToPHPValue($value, $platform)
    {
        if (!is_numeric($value)) {
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

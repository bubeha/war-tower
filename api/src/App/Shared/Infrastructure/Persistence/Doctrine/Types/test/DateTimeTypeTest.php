<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Types\test;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Infrastructure\Persistence\Doctrine\Types\DateTimeType;
use DateTimeImmutable;
use DG\BypassFinals;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 *
 * @internal
 */
final class DateTimeTypeTest extends TestCase
{
    private Type $type;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    protected function setUp(): void
    {
        BypassFinals::enable();

        Type::overrideType(Types::DATETIME_IMMUTABLE, DateTimeType::class);

        $this->type = Type::getType(Types::DATETIME_IMMUTABLE);
    }

    public function testGivenTypeWhenGetSqlDeclarationThenItShouldPrintThePlatformString(): void
    {
        self::assertSame('TIMESTAMP(0) WITHOUT TIME ZONE', $this->type->getSQLDeclaration([], new PostgreSQLPlatform()));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithEmptyValueShouldReturnNull(): void
    {
        self::assertNull($this->type->convertToPHPValue(null, new PostgreSQLPlatform()));
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithStringShouldReturnDateTime(): void
    {
        self::assertInstanceOf(
            DateTime::class,
            $this->type->convertToPHPValue(
                DateTime::now(),
                new PostgreSQLPlatform(),
            ),
        );
    }

    public function testGivenTypeWithIncorrectValueShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);

        $this->type->convertToPHPValue(12_345_678, new PostgreSQLPlatform());
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithNullValueThenItShouldReturnNull(): void
    {
        self::assertNull($this->type->convertToDatabaseValue(null, new PostgreSQLPlatform()));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function testGivenTypeWithDateTimeValueThenItShouldReturnString(): void
    {
        $now = DateTime::now();
        $value = $this->type->convertToDatabaseValue($now, new PostgreSQLPlatform());

        self::assertIsString($value);
        self::assertSame($now->toString(), $value);
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithDateTimeImmutableValueThenItShouldReturnString(): void
    {
        $now = new DateTimeImmutable();
        $value = $this->type->convertToDatabaseValue($now, new PostgreSQLPlatform());

        self::assertIsString($value);
        self::assertSame($now->format(DateTime::FORMAT), $value);
    }

    public function testGivenTypeWithIncorrectValueThenIShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);
        $any = Mockery::any();

        $this->type->convertToDatabaseValue($any, new PostgreSQLPlatform());
    }
}

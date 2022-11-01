<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Types\test;

use PHPUnit\Framework\TestCase;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Persistence\Doctrine\Types\UuidType;
use DG\BypassFinals;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Mockery;

/**
 * @group unit
 *
 * @internal
 */
final class UuidTypeTest extends TestCase
{
    private Type $type;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    protected function setUp(): void
    {
        BypassFinals::enable();

        if (!Type::hasType(UuidType::TYPE)) {
            Type::addType(UuidType::TYPE, UuidType::class);
        }

        $this->type = Type::getType(UuidType::TYPE);
    }

    public function testGivenTypeWhenGetSqlDeclarationThenItShouldPrintThePlatformString(): void
    {
        self::assertSame('UUID', $this->type->getSQLDeclaration([], new PostgreSQLPlatform()));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithEmptyValueShouldReturnNull(): void
    {
        self::assertNull($this->type->convertToPHPValue(null, new PostgreSQLPlatform()));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithStringShouldReturnUuid(): void
    {
        self::assertInstanceOf(
            Uuid::class,
            $this->type->convertToPHPValue(
                Uuid::generate(),
                new PostgreSQLPlatform()
            )
        );
    }

    public function testGivenTypeWithIncorrectValueShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);

        $this->type->convertToPHPValue(12_345_678, new PostgreSQLPlatform());
    }

    public function testGivenTypeWithIncorrectStringValueShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);

        $this->type->convertToPHPValue('incorrect-string', new PostgreSQLPlatform());
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
     */
    public function testGivenTypeWithUuidValueThenItShouldReturnString(): void
    {
        $uuid = Uuid::generate();

        $value = $this->type->convertToDatabaseValue($uuid, new PostgreSQLPlatform());

        self::assertIsString($value);
        self::assertSame($uuid->toString(), $value);
    }

    public function testGivenTypeWithIncorrectValueThenIShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);
        $any = Mockery::any();

        $this->type->convertToDatabaseValue($any, new PostgreSQLPlatform());
    }
}

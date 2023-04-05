<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Persistence\Doctrine\Types;

use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Infrastructure\Persistence\Doctrine\Types\UuidType;
use DG\BypassFinals;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 *
 * @internal
 */
final class UuidTypeTest extends TestCase
{
    private Type $type;

    private AbstractPlatform $platform;

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
        $this->platform = $this->getPlatformMock();
    }

    public function testGivenTypeWhenGetSqlDeclarationThenItShouldPrintThePlatformString(): void
    {
        self::assertSame('UUID', $this->type->getSQLDeclaration([], $this->platform));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithEmptyValueShouldReturnNull(): void
    {
        self::assertNull($this->type->convertToPHPValue(null, $this->platform));
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
                $this->platform,
            ),
        );
    }

    public function testGivenTypeWithIncorrectValueShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);

        $this->type->convertToPHPValue(12_345_678, $this->platform);
    }

    public function testGivenTypeWithIncorrectStringValueShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);

        $this->type->convertToPHPValue('incorrect-string', $this->platform);
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithNullValueThenItShouldReturnNull(): void
    {
        self::assertNull($this->type->convertToDatabaseValue(null, $this->platform));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithUuidValueThenItShouldReturnString(): void
    {
        $uuid = Uuid::generate();

        $value = $this->type->convertToDatabaseValue($uuid, $this->platform);

        self::assertIsString($value);
        self::assertSame($uuid->toString(), $value);
    }

    public function testGivenTypeWithIncorrectValueThenIShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);
        $any = Mockery::any();

        $this->type->convertToDatabaseValue($any, $this->platform);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    private function getPlatformMock(): AbstractPlatform
    {
        $mockObject = $this->createMock(AbstractPlatform::class);

        $mockObject->method('getGuidTypeDeclarationSQL')
            ->willReturn('UUID')
        ;

        return $mockObject;
    }
}

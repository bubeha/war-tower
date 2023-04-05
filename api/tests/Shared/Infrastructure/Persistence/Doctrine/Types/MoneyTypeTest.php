<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Persistence\Doctrine\Types;

use App\Shared\Domain\ValueObject\Money;
use App\Shared\Infrastructure\Persistence\Doctrine\Types\MoneyType;
use DG\BypassFinals;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Exception;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
final class MoneyTypeTest extends TestCase
{
    private AbstractPlatform $platform;

    private Type $type;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    protected function setUp(): void
    {
        BypassFinals::enable();

        if (!Type::hasType(MoneyType::TYPE)) {
            Type::addType(MoneyType::TYPE, MoneyType::class);
        }

        $this->type = Type::getType(MoneyType::TYPE);
        $this->platform = $this->getPlatformMock();
    }

    public function testGivenTypeWhenGetSqlDeclarationThenItShouldPrintThePlatformString(): void
    {
        self::assertSame('INT', $this->type->getSQLDeclaration([], $this->platform));
    }

    public function testGivenTypeWithIncorrectEmailThenShouldThrowAnException(): void
    {
        $this->expectException(ConversionException::class);
        $this->type->convertToPHPValue('not-valid', $this->platform);
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithEmailVOThenShouldReturnMoney(): void
    {
        $value = 1000;

        self::assertInstanceOf(Money::class, $this->type->convertToPHPValue($value, $this->platform));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithNullThenShouldReturnNull(): void
    {
        self::assertNull($this->type->convertToPHPValue(null, $this->platform));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithIntegerThenShouldReturnMoney(): void
    {
        self::assertInstanceOf(
            Money::class,
            $this->type->convertToPHPValue(1000, $this->platform),
        );
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithNullValueThenItShouldReturnNull(): void
    {
        self::assertNull($this->type->convertToDatabaseValue(null, $this->platform));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGivenTypeWithIncorrectValueThenIShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);
        $any = $this->createMock(stdClass::class);

        $this->type->convertToDatabaseValue($any, $this->platform);
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     * @throws Exception
     */
    public function testGivenTypeWithCorrectValueThenIShouldReturnCorrectValue(): void
    {
        $value = \random_int(1000, 9999);

        self::assertSame($value * 100, $this->type->convertToDatabaseValue(Money::fromOriginal($value), $this->platform));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    private function getPlatformMock(): AbstractPlatform
    {
        $mockObject = $this->createMock(AbstractPlatform::class);

        $mockObject->method('getIntegerTypeDeclarationSQL')
            ->willReturn('INT')
        ;

        return $mockObject;
    }
}

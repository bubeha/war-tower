<?php

declare(strict_types=1);

namespace App\Tests\User\Infrastructure\Persistence\Doctrine\Types;

use App\User\Domain\ValueObject\Email;
use App\User\Infrastructure\Persistence\Doctrine\Types\EmailType;
use DG\BypassFinals;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
final class EmailTypeTest extends TestCase
{
    private Type $type;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    protected function setUp(): void
    {
        BypassFinals::enable();

        if (!Type::hasType(EmailType::TYPE)) {
            Type::addType(EmailType::TYPE, EmailType::class);
        }

        $this->type = Type::getType(EmailType::TYPE);
    }

    public function testGivenTypeWhenGetSqlDeclarationThenItShouldPrintThePlatformString(): void
    {
        self::assertSame('VARCHAR(255)', $this->type->getSQLDeclaration([], new PostgreSQLPlatform()));
    }

    public function testGivenTypeWithIncorrectEmailThenShouldThrowAnException(): void
    {
        $this->expectException(ConversionException::class);
        $this->type->convertToPHPValue('not-valid-email', new PostgreSQLPlatform());
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithEmptyValueThenShouldReturnNull(): void
    {
        self::assertNull($this->type->convertToPHPValue(null, new PostgreSQLPlatform()));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithEmailVOThenShouldReturnEmail(): void
    {
        $email = self::createMock(Email::class);

        self::assertInstanceOf(Email::class, $this->type->convertToPHPValue($email, new PostgreSQLPlatform()));
    }

    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function testGivenTypeWithStringThenShouldReturnEmail(): void
    {
        self::assertInstanceOf(
            Email::class,
            $this->type->convertToPHPValue('some@email.com', new PostgreSQLPlatform()),
        );
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
    public function testGivenTypeWithEmailValueThenItShouldReturnString(): void
    {
        $email = $this->createMock(Email::class);

        $email->method('toString')
            ->willReturn('some@email.com')
        ;

        $value = $this->type->convertToDatabaseValue($email, new PostgreSQLPlatform());

        self::assertIsString($value);
        self::assertSame('some@email.com', $value);
    }

    public function testGivenTypeWithIncorrectValueThenIShouldThrowException(): void
    {
        $this->expectException(ConversionException::class);
        $any = $this->createMock(stdClass::class);

        $this->type->convertToDatabaseValue($any, new PostgreSQLPlatform());
    }
}

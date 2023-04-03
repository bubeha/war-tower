<?php

declare(strict_types=1);

namespace App\Tests\User\Domain\ValueObject;

use App\User\Domain\ValueObject\Email;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

/**
 * @internal
 */
final class EmailTest extends TestCase
{
    public function testFromString(): void
    {
        $faker = Factory::create();
        $email = $faker->email();

        self::assertEquals(Email::fromString($email), Email::fromString($email));
    }

    public function testToString(): void
    {
        $faker = Factory::create();
        $email = $faker->email();

        self::assertSame($email, Email::fromString($email)->toString());
        self::assertSame($email, (string)Email::fromString($email));
    }

    public function testValidation(): void
    {
        $faker = Factory::create();
        $email = $faker->name();

        $this->expectException(InvalidArgumentException::class);

        Email::fromString($email);
    }
}

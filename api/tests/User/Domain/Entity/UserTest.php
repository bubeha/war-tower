<?php

declare(strict_types=1);

namespace App\Tests\User\Domain\Entity;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\Email;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class UserTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testUserCreate(): void
    {
        $id = Uuid::generate();
        $date = DateTime::now();

        $faker = Factory::create();

        $name = $faker->name();
        $nickname = $faker->slug();
        $email = Email::fromString($faker->email());

        $user = User::create($id, $name, $nickname, $email, $date);

        self::assertSame($id, $user->getId());
        self::assertSame($date, $user->getCreatedAt());
        self::assertSame($name, $user->getName());
        self::assertSame($nickname, $user->getNickname());
        self::assertSame($email, $user->getEmail());
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testUserUpdate(): void
    {
        $id = Uuid::generate();
        $date = DateTime::now();

        $faker = Factory::create();

        $user = User::create($id, $faker->name(), $faker->slug(), Email::fromString($faker->email()), $date);

        $name = $faker->name();
        $user->setName($name);
        self::assertSame($name, $user->getName());

        $nickname = $faker->slug();
        $user->setNickname($nickname);
        self::assertSame($nickname, $user->getNickname());

        $email = Email::fromString($faker->email());
        $user->setEmail($email);
        self::assertSame($email, $user->getEmail());

        self::assertSame($id, $user->getId());
        self::assertSame($date, $user->getCreatedAt());
    }
}

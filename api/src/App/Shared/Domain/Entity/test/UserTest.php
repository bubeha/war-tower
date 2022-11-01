<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\test;

use App\Shared\Domain\Entity\User;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function testUserCreate(): void
    {
        $id = Uuid::generate();
        $date = DateTime::now();

        $user = User::create($id, $date);

        self::assertSame($id, $user->getId());
        self::assertSame($date, $user->getCreatedAt());
        self::assertNull($user->getUpdatedAt());
    }
}

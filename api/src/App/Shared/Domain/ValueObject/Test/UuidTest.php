<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject\Test;

use App\Shared\Domain\ValueObject\Id\Uuid;
use InvalidArgumentException;
use JsonException;
use PHPUnit\Framework\TestCase;

use function json_encode;

/**
 * @internal
 */
final class UuidTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testSerialization(): void
    {
        $uuid = Uuid::generate();

        self::assertSame((string)$uuid, $uuid->toString());
        self::assertSame(json_encode($uuid->toString(), JSON_THROW_ON_ERROR), json_encode($uuid, JSON_THROW_ON_ERROR));
    }

    public function testIncorrectUuid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Uuid::fromString('incorrect');
    }

    public function testTwoDifferentUuids(): void
    {
        self::assertFalse(Uuid::generate()->equals(Uuid::generate()));
    }

    public function testTwoSaveUuids(): void
    {
        $uuid = Uuid::generate();
        self::assertTrue($uuid->equals(Uuid::fromString($uuid->toString())));
    }
}

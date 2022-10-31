<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject\Test;

use App\Shared\Domain\Exception\DateTimeException;
use App\Shared\Domain\ValueObject\DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class DateTimeTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function testNow(): void
    {
        $now = new DateTimeImmutable('now');

        self::assertSame('0', $now->diff(DateTime::now())->format('%a'));
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function testToString(): void
    {
        $now = DateTime::fromString('-1 day');

        self::assertSame($now->format(DateTime::FORMAT), $now->toString());
    }

    public function testBadDateTime(): void
    {
        $this->expectException(DateTimeException::class);

        DateTime::fromString('incorrect datetime');
    }
}

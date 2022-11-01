<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject\Test;

use App\Shared\Domain\ValueObject\Money;
use Exception;
use PHPUnit\Framework\TestCase;

use function random_int;

/**
 * @internal
 */
final class MoneyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testConversion(): void
    {
        $expected = random_int(10, 999) / 100;
        self::assertSame(Money::fromOriginal($expected)->getOriginal(), $expected);

        $expected = random_int(10, 999) / 100;
        self::assertSame(Money::fromOriginal($expected)->getConverted(), (int)($expected * 100));

        $expected = random_int(100, 999);
        self::assertSame(Money::fromConverted($expected)->getOriginal(), $expected / 100);

        $expected = random_int(100, 999);
        self::assertSame(Money::fromConverted($expected)->getConverted(), $expected);
    }
}

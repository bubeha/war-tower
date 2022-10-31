<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject\Test;

use App\Shared\Domain\ValueObject\Slug;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class SlugTest extends TestCase
{
    public function testConversion(): void
    {
        self::assertSame(Slug::fromString('some-slug')->toString(), 'some-slug');
        self::assertSame((string)Slug::fromString('some-slug'), 'some-slug');
    }
}

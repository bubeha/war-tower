<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exception\test;

use App\Shared\Domain\Exception\DateTimeException;
use App\Shared\Domain\ValueObject\DateTime;
use PHPUnit\Framework\TestCase;

final class TestDateTimeException extends TestCase
{
    public function testException(): void
    {
        $this->expectException(DateTimeException::class);

        DateTime::create('incorrect value');
    }
}

<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject\Test;

use App\Shared\Domain\ValueObject\Experience;
use Exception;
use PHPUnit\Framework\TestCase;

use function random_int;

/**
 * @internal
 */
final class ExperienceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetValue(): void
    {
        $data = random_int(0, 255);
        self::assertSame($data, Experience::create($data)->getValue());
    }

    public function testCreateDefault(): void
    {
        self::assertSame(0, Experience::createDefault()->getValue());
    }
}

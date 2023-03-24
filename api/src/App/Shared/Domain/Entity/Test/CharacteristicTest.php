<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\Test;

use App\Shared\Domain\Entity\Characteristic;
use App\Shared\Domain\ValueObject\DateTime;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

/**
 * @internal
 */
final class CharacteristicTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testCharacteristicCreate(): void
    {
        $faker = Factory::create();

        $id = \random_bytes(\random_int(5, 15));
        $name = $faker->name();
        $createdAt = DateTime::now();

        $characteristic = new Characteristic($id, $name, $createdAt);
        assertSame($id, $characteristic->getId());
        assertSame($name, $characteristic->getName());
        assertSame($createdAt, $characteristic->getCreatedAt());
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testCharacteristicUpdate(): void
    {
        $faker = Factory::create();

        $id = \random_bytes(\random_int(5, 15));
        $name = $faker->name();
        $createdAt = DateTime::now();

        $characteristic = new Characteristic($id, $name, $createdAt);
        assertSame($id, $characteristic->getId());
        assertSame($name, $characteristic->getName());
        assertSame($createdAt, $characteristic->getCreatedAt());

        $name = $faker->name();
        $characteristic->setName($name);
        assertSame($name, $characteristic->getName());
    }
}

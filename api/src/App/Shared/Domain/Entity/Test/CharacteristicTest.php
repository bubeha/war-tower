<?php

namespace App\Shared\Domain\Entity\Test;

use App\Shared\Domain\Entity\Characteristic;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

final class CharacteristicTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function testCharacteristicCreate(): void
    {
        $faker = Factory::create();

        $id = Uuid::generate();
        $name = $faker->name();
        $createdAt = DateTime::now();

        $characteristic = new Characteristic($id, $name, $createdAt);
        assertSame($id, $characteristic->getId());
        assertSame($name, $characteristic->getName());
        assertSame($createdAt, $characteristic->getCreatedAt());
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function testCharacteristicUpdate(): void
    {
        $faker = Factory::create();

        $id = Uuid::generate();
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

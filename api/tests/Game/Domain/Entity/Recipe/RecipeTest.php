<?php

declare(strict_types=1);

namespace App\Tests\Game\Domain\Entity\Recipe;

use App\Game\Domain\Entity\Recipe\Item;
use App\Game\Domain\Entity\Recipe\Recipe;
use App\Game\Domain\Entity\Unit\Unit;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RecipeTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testCreate(): void
    {
        $faker = Factory::create();

        $id = Uuid::generate()->toString();
        $name = $faker->name();
        $unit = $this->createMock(Unit::class);
        $createdAt = DateTime::now();

        $recipe = Recipe::create($id, $name, $unit, $createdAt);

        self::assertEquals($recipe->getId(), $id);
        self::assertSame($recipe->getName(), $name);
        self::assertEquals($recipe->getUnit(), $unit);
        self::assertEquals($recipe->getCreatedAt(), $createdAt);
        self::assertContainsOnlyInstancesOf(Collection::class, $recipe->getItems());

        $name = $faker->name();
        $recipe->setName($name);
        self::assertSame($name, $recipe->getName());

        $unit = $this->createMock(Unit::class);
        $recipe->setUnit($unit);
        self::assertSame($unit, $recipe->getUnit());

        $items = [];

        for ($i = 0; $i < \random_int(1, 5); ++$i) {
            $items[] = $this->createMock(Item::class);
        }

        /**
         * @var \Doctrine\Common\Collections\Collection<int, \App\Game\Domain\Entity\Recipe\Item> $collection
         */
        $collection = new ArrayCollection($items);
        $recipe->setItems($collection);
        self::assertSame($items, $recipe->getItems()->toArray());
    }
}

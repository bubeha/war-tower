<?php

declare(strict_types=1);

namespace App\Tests\Game\Domain\Entity\Recipe;

use App\Game\Domain\Entity\Recipe\Item;
use App\Game\Domain\Entity\Recipe\Recipe;
use App\Game\Domain\Entity\Unit\Unit;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ItemTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testCreate(): void
    {
        $id = Uuid::generate();
        $recipe = $this->createMock(Recipe::class);
        $unit = $this->createMock(Unit::class);
        $quantity = \random_int(1, 5);
        $createdAt = DateTime::now();

        $item = Item::create($id, $recipe, $unit, $quantity, $createdAt);

        self::assertEquals($id, $item->getId());
        self::assertEquals($recipe, $item->getRecipe());
        self::assertEquals($unit, $item->getUnit());
        self::assertSame($quantity, $item->getQuantity());

        $quantity = \random_int(6, 10);
        $item->setQuantity($quantity);
        self::assertSame($quantity, $item->getQuantity());

        self::assertEquals($createdAt, $item->getCreatedAt());
    }
}

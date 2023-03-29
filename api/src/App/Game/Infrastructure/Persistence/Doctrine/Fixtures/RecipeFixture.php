<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Game\Domain\Entity\Recipe\Item;
use App\Game\Domain\Entity\Recipe\Recipe;
use App\Game\Domain\Repository\Unit\FindAll;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use LogicException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RecipeFixture extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly FindAll $repository)
    {
    }

    public function getDependencies(): array
    {
        return [UnitFixture::class];
    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        /** @var non-empty-array<int, \App\Game\Domain\Entity\Unit\Unit> $units */
        $units = $this->repository->all();

        $length = \random_int(3, (int)(\count($units) / 2));
        $keys = \array_rand($units, $length);

        if (!\is_array($keys)) {
            throw new LogicException('Incorrect length. Expected: ' . $length);
        }

        $newUnitsRecipe = [];

        foreach ($keys as $key) {
            $newUnitsRecipe[] = $units[$key];
            unset($units[$key]);
        }

        foreach ($newUnitsRecipe as $key => $unit) {
            $recipe = Recipe::create('recipe-' . $key, ' Recipe: ' . $unit->getName() . $key, $unit);

            /** @var non-empty-array<int, \App\Game\Domain\Entity\Unit\Unit> $units */
            $randomKeys = \array_rand($units, \random_int(2, (int)(\count($units) / 3)));

            if (!\is_array($randomKeys)) {
                throw new LogicException('Incorrect length. Expected: ' . $length);
            }

            /** @var \Doctrine\Common\Collections\Collection<int, Item> $items */
            $items = new ArrayCollection(
                \array_map(static fn($item) => Item::create(Uuid::generate(), $recipe, $units[$item], \random_int(1, 5)), $randomKeys),
            );
            $recipe->setItems($items);

            $manager->persist($recipe);
        }

        $manager->flush();
    }
}

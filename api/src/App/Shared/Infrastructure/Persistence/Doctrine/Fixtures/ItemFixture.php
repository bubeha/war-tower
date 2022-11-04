<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Recipe\Item;
use App\Shared\Domain\Entity\Recipe\Recipe;
use App\Shared\Domain\Repository\Product\ProductRepository;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ItemFixture extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function getDependencies(): array
    {
        return [RecipeFixture::class];
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function load(ObjectManager $manager): void
    {
        $product = $this->repository->getProductForFixture('Weapon', 'Raw');

        $recipes = $manager->getRepository(Recipe::class)
            ->findAll()
        ;

        foreach ($recipes as $recipe) {
            $entry = Item::create(Uuid::generate(), $recipe, $product, 5);
            $manager->persist($entry);
        }
        $manager->flush();
    }
}

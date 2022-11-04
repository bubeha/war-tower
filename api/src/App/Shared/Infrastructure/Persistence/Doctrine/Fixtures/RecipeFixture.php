<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Domain\Entity\Recipe\Recipe;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class RecipeFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            ProductFixture::class,
        ];
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function load(ObjectManager $manager): void
    {
        $products = $manager->getRepository(Product::class)
            ->findAll()
        ;

        foreach ($products as $product) {
            $entry = Recipe::create(Uuid::generate(), $product);
            $manager->persist($entry);
        }

        $manager->flush();
    }
}

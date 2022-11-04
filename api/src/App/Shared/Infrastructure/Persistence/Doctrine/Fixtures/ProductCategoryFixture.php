<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Product\Category;
use App\Shared\Domain\Entity\Product\Detail;
use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProductCategoryFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            ProductFixture::class,
            ProductFixture::class,
        ];
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function load(ObjectManager $manager): void
    {
        $products = $manager->getRepository(Detail::class)->findAll();
        $categories = $manager->getRepository(Category::class)->findAll();

        foreach ($products as $product) {
            foreach ($categories as $category) {
                $entry = Product::create(Uuid::generate(), $product, $category);
                $manager->persist($entry);
            }
        }

        $manager->flush();
    }
}

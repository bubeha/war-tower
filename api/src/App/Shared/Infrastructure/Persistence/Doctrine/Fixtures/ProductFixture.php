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

final class ProductFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            DetailFixture::class,
            CategoryFixture::class,
        ];
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function load(ObjectManager $manager): void
    {
        $details = $manager->getRepository(Detail::class)->findAll();
        $categories = $manager->getRepository(Category::class)->findAll();

        foreach ($details as $detail) {
            foreach ($categories as $category) {
                $product = Product::create(Uuid::generate(), $detail, $category);
                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}

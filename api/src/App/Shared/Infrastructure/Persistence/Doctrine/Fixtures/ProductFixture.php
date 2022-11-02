<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Product;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ProductFixture extends Fixture
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getProducts() as $product) {
            $manager->persist($product);
        }

        $manager->flush();
    }

    /**
     * @return array<\App\Shared\Domain\Entity\Product>
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function getProducts(): array
    {
        return [
            Product::create(Uuid::generate(), 'Trooper Weapon'),
            Product::create(Uuid::generate(), 'Defender Weapon'),
            Product::create(Uuid::generate(), 'Support Weapon'),
            Product::create(Uuid::generate(), 'Sniper Weapon'),
            Product::create(Uuid::generate(), 'Weapon'),
        ];
    }
}

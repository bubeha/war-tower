<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Product\Detail;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class DetailFixture extends Fixture
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
     * @return array<\App\Shared\Domain\Entity\Product\Detail>
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function getProducts(): array
    {
        return [
            Detail::create(Uuid::generate(), 'Trooper Weapon'),
            Detail::create(Uuid::generate(), 'Defender Weapon'),
            Detail::create(Uuid::generate(), 'Support Weapon'),
            Detail::create(Uuid::generate(), 'Sniper Weapon'),
            Detail::create(Uuid::generate(), 'Weapon'),
        ];
    }
}

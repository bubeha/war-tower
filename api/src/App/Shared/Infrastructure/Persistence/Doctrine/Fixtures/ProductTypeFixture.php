<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\ProductType;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ProductTypeFixture extends Fixture
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $type) {
            $manager->persist($type);
        }

        $manager->flush();
    }

    /**
     * @return array<ProductType>
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    private function getData(): array
    {
        return [
            ProductType::create(Uuid::generate(), 'Speed'),
            ProductType::create(Uuid::generate(), 'Light'),
            ProductType::create(Uuid::generate(), 'Medium'),
            ProductType::create(Uuid::generate(), 'Heavy'),
        ];
    }
}

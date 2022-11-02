<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Category;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixture extends Fixture
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
     * @return array<Category>
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    private function getData(): array
    {
        return [
            Category::create(Uuid::generate(), 'Speed'),
            Category::create(Uuid::generate(), 'Light'),
            Category::create(Uuid::generate(), 'Medium'),
            Category::create(Uuid::generate(), 'Heavy'),
            Category::create(Uuid::generate(), 'Raw'),
        ];
    }
}

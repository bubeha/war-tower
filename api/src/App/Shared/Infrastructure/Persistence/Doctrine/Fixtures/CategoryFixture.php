<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Category;
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
            Category::create('speed', 'Speed'),
            Category::create('light', 'Light'),
            Category::create('medium', 'Medium'),
            Category::create('heavy', 'Heavy'),
            Category::create('raw', 'Raw'),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Characteristic;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CharacteristicFixture extends Fixture
{

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $name) {
            $manager->persist(Characteristic::create(Uuid::generate(), $name));
        }

        $manager->flush();
    }

    /**
     * @return list<string>
     */
    private function getData(): array
    {
        return [
            'Cost',
            'Experience',
            'Craft Time',
            'Attack',
            'Health',
            'Defence',
            'Initiative',
        ];
    }
}

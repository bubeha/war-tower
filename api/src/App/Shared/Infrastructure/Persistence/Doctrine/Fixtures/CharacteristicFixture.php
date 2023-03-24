<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Characteristic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CharacteristicFixture extends Fixture
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $characteristic) {
            $manager->persist($characteristic);
        }

        $manager->flush();
    }

    /**
     * @return list<Characteristic>
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    private function getData(): array
    {
        return [
            Characteristic::create('cost', 'Cost'),
            Characteristic::create('experience', 'Experience'),
            Characteristic::create('craft_time', 'Craft Time'),
            Characteristic::create('attack', 'Attack'),
            Characteristic::create('health', 'Health'),
            Characteristic::create('defence', 'Defence'),
            Characteristic::create('initiative', 'Initiative'),
        ];
    }
}

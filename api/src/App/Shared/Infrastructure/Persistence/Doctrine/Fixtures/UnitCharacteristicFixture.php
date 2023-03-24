<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Unit\Characteristic;
use App\Shared\Domain\Repository\Characteristic\FindAll as FindAllCategories;
use App\Shared\Domain\Repository\Unit\FindAll as FindAllUnits;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class UnitCharacteristicFixture extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly FindAllCategories $characteristicRepository, private readonly FindAllUnits $unitRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $characteristics = $this->characteristicRepository->all();
        $units = $this->unitRepository->all();

        foreach ($units as $unit) {
            foreach ($characteristics as $characteristic) {
                $manager->persist(
                    Characteristic::create(Uuid::generate(), $unit, $characteristic, \random_int(1, 100)),
                );
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CharacteristicFixture::class,
            UnitFixture::class,
        ];
    }
}

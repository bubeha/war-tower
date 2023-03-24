<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Shared\Domain\Entity\Unit\Cost;
use App\Shared\Domain\Repository\Unit\FindAll;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CostFixture extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly FindAll $unitRepository)
    {
    }

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

    public function getDependencies(): array
    {
        return [
            UnitFixture::class,
        ];
    }

    /**
     * @return list<\App\Shared\Domain\Entity\Unit\Cost>
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    private function getData(): array
    {
        $result = [];

        foreach ($this->unitRepository->all() as $unit) {
            $result[] = Cost::create(Uuid::generate(), $unit, \random_int(1, 1_000_000));
        }

        return $result;
    }
}

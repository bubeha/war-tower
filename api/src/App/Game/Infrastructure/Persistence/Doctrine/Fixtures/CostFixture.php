<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Game\Domain\Entity\Unit\Cost;
use App\Game\Domain\Repository\Unit\FindAll;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Domain\ValueObject\Money;
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
     * @return list<Cost>
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    private function getData(): array
    {
        $result = [];

        foreach ($this->unitRepository->all() as $unit) {
            $original = \random_int(1, 1_000_000);
            $result[] = Cost::create(Uuid::generate(), $unit, Money::fromOriginal($original));
        }

        return $result;
    }
}

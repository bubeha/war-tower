<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Persistence\Doctrine\Fixtures;

use App\Game\Domain\Entity\Unit\Unit;
use App\Game\Domain\Repository\Category\FindAll;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Domain\ValueObject\Slug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class UnitFixture extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly FindAll $categoryRepository)
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
            CategoryFixture::class,
        ];
    }

    /**
     * @return list<Unit>
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    private function getData(): array
    {
        $result = [];

        foreach ($this->categoryRepository->all() as $category) {
            foreach (\range(1, 4) as $value) {
                $name = "Component {$value}";

                $result[] = Unit::create(
                    Uuid::generate(),
                    $category,
                    Slug::fromArray($category->getName(), $name),
                    $name,
                );
            }
        }

        return $result;
    }
}

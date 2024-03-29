<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Persistence\Generator;

use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Infrastructure\Persistence\Doctrine\Generator\UuidGenerator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class UuidGeneratorTest extends TestCase
{
    public function testUuidGeneratorGenerate(): void
    {
        /** @var \Doctrine\ORM\EntityManagerInterface $em */
        $em = Mockery::mock(EntityManager::class);
        $entity = new Entity();
        $generator = new UuidGenerator();

        $uuid = $generator->generate($em, $entity);

        self::assertInstanceOf(Uuid::class, $uuid);
    }
}

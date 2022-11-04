<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\test;

use App\Shared\Domain\Entity\Product\Category;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;
use Exception;
use PHPUnit\Framework\TestCase;

use function random_bytes;
use function random_int;

/**
 * @internal
 */
final class CategoryTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testCategoryCreate(): void
    {
        $id = Uuid::generate();
        $date = DateTime::now();
        $name = $this->generateString();

        $category = Category::create($id, $name, $date);

        self::assertSame($id, $category->getId());
        self::assertSame($name, $category->getName());
        self::assertSame($date, $category->getCreatedAt());
        self::assertNull($category->getUpdatedAt());
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testModifyCategory(): void
    {
        $id = Uuid::generate();

        $category = Category::create($id, $this->generateString());

        $newName = $this->generateString();
        $category->setName($newName);

        self::assertSame($newName, $category->getName());
        self::assertNotNull($category->getUpdatedAt());
    }

    /**
     * @throws Exception
     */
    private function generateString(): string
    {
        return random_bytes(random_int(1, 255));
    }
}

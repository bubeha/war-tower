<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\Test;

use App\Shared\Domain\Entity\Category;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Exception;
use PHPUnit\Framework\TestCase;

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
    }

    /**
     * @throws Exception
     */
    private function generateString(): string
    {
        return \random_bytes(\random_int(1, 255));
    }
}

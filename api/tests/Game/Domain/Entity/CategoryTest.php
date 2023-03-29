<?php

declare(strict_types=1);

namespace App\Tests\Game\Domain\Entity;

use App\Game\Domain\Entity\Category;
use App\Shared\Domain\ValueObject\DateTime;
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
        $id = \random_bytes(\random_int(5, 15));
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
        $id = \random_bytes(\random_int(5, 15));

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

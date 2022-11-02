<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\test;

use App\Shared\Domain\Entity\Category;
use App\Shared\Domain\Entity\Product;
use App\Shared\Domain\Entity\ProductCategory;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

class ProductCategoryTest extends TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws \Exception
     */
    public function testProductCategoryTest(): void
    {
        $product = Product::create(Uuid::generate(), $this->generateString());
        $category = Category::create(Uuid::generate(), $this->generateString());

        $id = Uuid::generate();
        $date = DateTime::now();
        $productCategory = ProductCategory::create($id, $product, $category, $date);

        self::assertSame($id, $productCategory->getId());
        self::assertSame($product, $productCategory->getProduct());
        self::assertSame($category, $productCategory->getCategory());
        self::assertSame($date, $productCategory->getCreatedAt());
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generateString(): string
    {
        return random_bytes(random_int(1, 255));
    }
}

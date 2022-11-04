<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\test;

use App\Shared\Domain\Entity\Category;
use App\Shared\Domain\Entity\Product;
use App\Shared\Domain\Entity\ProductCategory;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;
use DG\BypassFinals;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ProductCategoryTest extends TestCase
{
    protected function setUp(): void
    {
        BypassFinals::enable();
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testProductCategoryTest(): void
    {
        $product = Mockery::mock(Product::class);
        $category = Mockery::mock(Category::class);

        $id = Uuid::generate();
        $date = DateTime::now();
        $productCategory = ProductCategory::create($id, $product, $category, $date);

        self::assertSame($id, $productCategory->getId());
        self::assertSame($product, $productCategory->getProduct());
        self::assertSame($category, $productCategory->getCategory());
        self::assertSame($date, $productCategory->getCreatedAt());
    }
}

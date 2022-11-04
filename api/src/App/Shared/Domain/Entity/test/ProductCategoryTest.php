<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\test;

use App\Shared\Domain\Entity\Product\Category;
use App\Shared\Domain\Entity\Product\Detail;
use App\Shared\Domain\Entity\Product\Product;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
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
        $product = Mockery::mock(Detail::class);
        $category = Mockery::mock(Category::class);

        $id = Uuid::generate();
        $date = DateTime::now();
        $productCategory = Product::create($id, $product, $category, $date);

        self::assertSame($id, $productCategory->getId());
        self::assertSame($product, $productCategory->getDetail());
        self::assertSame($category, $productCategory->getCategory());
        self::assertSame($date, $productCategory->getCreatedAt());
    }
}

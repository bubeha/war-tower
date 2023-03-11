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
        /** @var Detail $detail */
        $detail = Mockery::mock(Detail::class);
        /** @var Category $category */
        $category = Mockery::mock(Category::class);

        $id = Uuid::generate();
        $date = DateTime::now();
        $productCategory = Product::create($id, $detail, $category, $date);

        self::assertSame($id, $productCategory->getId());
        self::assertSame($detail, $productCategory->getDetail());
        self::assertSame($category, $productCategory->getCategory());
        self::assertSame($date, $productCategory->getCreatedAt());
    }
}

<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\test;

use App\Shared\Domain\Entity\Product;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Uuid;

class ProductTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws \Exception
     */
    public function testProductCreate(): void
    {
        $id = Uuid::generate();
        $date = DateTime::now();
        $name = $this->generateString();

        $product = Product::create($id, $name, $date);

        self::assertSame($id, $product->getId());
        self::assertSame($name, $product->getName());
        self::assertSame($date, $product->getCreatedAt());
        self::assertNull($product->getUpdatedAt());
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws \Exception
     */
    public function testModifyProduct(): void
    {
        $id = Uuid::generate();

        $product = Product::create($id, $this->generateString());

        $newName = $this->generateString();
        $product->setName($newName);

        self::assertSame($newName, $product->getName());
        self::assertNotNull($product->getUpdatedAt());
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

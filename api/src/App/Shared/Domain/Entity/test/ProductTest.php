<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\test;

use App\Shared\Domain\Entity\Product\Detail;
use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use Exception;

/**
 * @internal
 */
final class ProductTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testProductCreate(): void
    {
        $id = Uuid::generate();
        $date = DateTime::now();
        $name = $this->generateString();

        $product = Detail::create($id, $name, $date);

        self::assertSame($id, $product->getId());
        self::assertSame($name, $product->getName());
        self::assertSame($date, $product->getCreatedAt());
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     * @throws Exception
     */
    public function testModifyProduct(): void
    {
        $id = Uuid::generate();

        $product = Detail::create($id, $this->generateString());

        $newName = $this->generateString();
        $product->setName($newName);

        self::assertSame($newName, $product->getName());
    }

    /**
     * @throws Exception
     */
    private function generateString(): string
    {
        return \random_bytes(\random_int(1, 255));
    }
}

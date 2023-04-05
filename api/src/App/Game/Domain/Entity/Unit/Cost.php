<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity\Unit;

use App\Shared\Domain\ValueObject\Id\Uuid;
use App\Shared\Domain\ValueObject\Money;

/**
 * @final
 */
class Cost
{
    public function __construct(private readonly Uuid $id, private readonly Unit $unit, private Money $price)
    {
    }

    public static function create(Uuid $id, Unit $unit, Money $cost): self
    {
        return new self($id, $unit, $cost);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): void
    {
        $this->price = $price;
    }
}

<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\Unit;

use App\Shared\Domain\ValueObject\Id\Uuid;

/**
 * @final
 */
class Cost
{
    public function __construct(private readonly Uuid $id, private readonly Unit $unit, private int $cost)
    {
    }

    public static function create(Uuid $id, Unit $unit, int $cost): self
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

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }
}

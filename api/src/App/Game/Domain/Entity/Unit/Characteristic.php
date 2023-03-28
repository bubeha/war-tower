<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity\Unit;

use App\Game\Domain\Entity\Characteristic as MainCharacteristic;
use App\Shared\Domain\ValueObject\Id\Uuid;

/**
 * @final
 */
class Characteristic
{
    public function __construct(private readonly Uuid $id, private readonly Unit $unit, private readonly MainCharacteristic $characteristic, private int $value)
    {
    }

    public static function create(Uuid $id, Unit $unit, MainCharacteristic $characteristic, int $value): self
    {
        return new self($id, $unit, $characteristic, $value);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }

    public function getCharacteristic(): MainCharacteristic
    {
        return $this->characteristic;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}
